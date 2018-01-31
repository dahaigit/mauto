namespace App\Http\Controllers\<?php echo $config['moduleName']; ?>;

use App\Models\<?php echo $tpName; ?>;
use Illuminate\Http\Request;

class <?php echo $tpName; ?>Controller extends <?php echo $config['baseController']; ?>

{
    /**
     * <?php echo $config['tableNameCn']; ?>列表
     * author  <?php echo $config['author']; ?>,
     * date    <?php echo date('Y-m-d H:i:s'); ?>,
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
<?php $results = '$'. lcfirst($tpName) . 's'; ?>
<?php $resultsObj = '$'. lcfirst($tpName) . 'Builder'; ?>
<?php $result = '$'. lcfirst($tpName); ?>
        <?php echo $resultsObj; ?> = <?php echo $tpName; ?>::orderBy('<?php echo $config['pk']; ?>', 'desc')<?php if (!empty($config['listShowFileds'][0])) {  ?>
        ->with(<?php foreach ($config['listShowFileds'] as $k => $listShowFiled) { ?>'<?php echo $listShowFiled["withName"]; ?>'<?php if ($k < $listShowFiledCount - 1) {
        echo ',';
    } ?><?php } ?>)
<?php } ?>;
<?php if (!empty($config['listSearchFileds'][0])) {  ?>
<?php foreach ($config['listSearchFileds'] as $listSearchFiled) { ?>
        <?php switch ($listSearchFiled['isPTable']) {
            case 0: ?>
<?php echo $resultsObj; ?>->when($request-><?php echo $listSearchFiled['filedName']; ?>, function ($query) use ($request) {
                $query-><?php echo $listSearchFiled['function']; ?>('<?php echo $listSearchFiled['filedName']; ?>', <?php echo $listSearchFiled['function'] == 'where' ? "'".$listSearchFiled['type']."'". ',' : '';?><?php if ($listSearchFiled['type'] == 'like') echo ' "%"' . '.' ; ?> $request-><?php echo $listSearchFiled['filedName']; ?><?php if ($listSearchFiled['type'] == 'like') echo '.' . ' "%"'; ?>);
            });
<?php break; case 1:  ?>if ($request-><?php echo $listSearchFiled['filedName'];?>) {
            <?php echo $resultsObj; ?>->whereHas('<?php echo $listSearchFiled['withName']; ?>', function ($query) use ($request) {
                    $query-><?php echo $listSearchFiled['function']; ?>('<?php echo $listSearchFiled['filedName']; ?>', <?php echo $listSearchFiled['function'] == 'where' ? "'".$listSearchFiled['type']."'". ',' : '';?><?php if ($listSearchFiled['type'] == 'like') echo '"%"' . '.' ; ?> $request-><?php echo $listSearchFiled['filedName']; ?> <?php if ($listSearchFiled['type'] == 'like') echo '.' . '"%"'; ?>);
                });
        }
        <?php }; ?><?php } ?><?php } ?>
        <?php echo $results; ?> = <?php echo $resultsObj; ?>->paginate(15);

        $rows = [];
        foreach (<?php echo $results; ?> as $k => <?php echo $result; ?>) {
            $rows[$k] = [
                    '<?php echo strtolower($tpName); ?>_<?php echo $config['pk']; ?>' => <?php echo $result; ?>->id,
        <?php foreach ($config['fillable'] as $vv) { ?>
            '<?php echo $vv; ?>' => <?php echo $result; ?>-><?php echo $vv; ?>,
        <?php } ?>
        ];
<?php if (!empty($config['listShowFileds'][0])) { ?>
    <?php foreach ($config['listShowFileds'] as $listShowFiled) { ?><?php if ($listShowFiled['isPluck']) { ?>
        $row[$k]['<?php echo $listShowFiled["showKey"]; ?>'] = <?php echo $result; ?>-><?php echo $listShowFiled["withName"]; ?>->pluck('<?php echo $listShowFiled["filedName"]; ?>')->toArray() ?? 0;
    <?php } else { ?>
        $row[$k]['<?php echo $listShowFiled["showKey"]; ?>'] = <?php echo $result; ?>-><?php echo $listShowFiled["withName"]; ?>-><?php echo $listShowFiled["filedName"]; ?> ?? 0;
    <?php   } ?>
    <?php } ?>
<?php } ?>
        }

        $data = [
            'currentPage' => <?php echo $results; ?>->currentPage(),
            'perPage' => <?php echo $results; ?>->perPage(),
            'total' => <?php echo $results; ?>->total(),
            'lastPage' => <?php echo $results; ?>->lastPage(),
            'rows' => $rows,
        ];

        return $this->apiResponse('请求成功！', R_OK, $data);
    }

    /**
    * <?php echo $config['tableNameCn']; ?>详情
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        <?php echo $result ?> = <?php echo $tpName; ?>::<?php if (!empty($config['listShowFileds'][0])) { ?>with(<?php foreach ($config['listShowFileds'] as $k => $listShowFiled) { ?>'<?php echo $listShowFiled["withName"]; ?>'<?php if ($k < $listShowFiledCount - 1) {
            echo ',';
        } ?><?php } ?>)-><?php } ?>findOrFail($id);

        $data = [];
        $data = [
            '<?php echo strtolower($tpName); ?>_<?php echo $config['pk']; ?>' => <?php echo $result; ?>->id,
    <?php foreach ($config['fillable'] as $vv) { ?>
        '<?php echo $vv; ?>' => <?php echo $result; ?>-><?php echo $vv; ?>,
    <?php } ?>
    ];
<?php if (!empty($config['listShowFileds'][0])) { ?>
        <?php foreach ($config['listShowFileds'] as $listShowFiled) { ?><?php if ($listShowFiled['isPluck']) { ?>
$data['<?php echo $listShowFiled["showKey"]; ?>'] = <?php echo $result; ?>-><?php echo $listShowFiled["withName"]; ?>->pluck('<?php echo $listShowFiled["filedName"]; ?>')->toArray() ?? 0;
        <?php } else { ?>
$data['<?php echo $listShowFiled["showKey"]; ?>'] = <?php echo $result; ?>-><?php echo $listShowFiled["withName"]; ?>-><?php echo $listShowFiled["filedName"]; ?> ?? 0;
        <?php   } ?>
        <?php } ?>
<?php } ?>

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
     * 添加<?php echo $config['tableNameCn']; ?>
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'keywords' => 'required',
            'message' => 'required',
            'is_open' => 'required|in:1,2',
        ], [
            'keywords.required' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_KEYWORDS_EMPTY),
            'message.required' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_MESSAGE_EMPTY),
            'is_open.required' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_IS_OPEN_EMPTY),
            'is_open.in' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_IS_OPEN_IN),
        ]);
        $this->validatorErrors($validator);

        \DB::beginTransaction();
        try {
            $wechatMessage = WechatMessage::create([
                'keywords' => $request->keywords,
                'message' => $request->message,
                'is_pen' => $request->is_open,
            ]);

            \DB::commit();
            return $this->apiResponse('添加成功！', Code::R_OK);
        } catch (\Exception $e) {
            \DB::rollBack();
            dd($e);
        }
    }

    /**
    * 删除<?php echo $config['tableNameCn']; ?>

    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        <?php echo $tpName; ?>::where('id', $id)->delete();
        return $this->apiResponse("删除成功", Code::R_OK);
    }
}
