namespace App\Http\Controllers\<?php echo $config['moduleName'] .'\\'. ucfirst(strtolower($this->_productModule));; ?>;

use App\Models\<?php echo $tpName; ?>;
use App\Contracts\Code;
use Illuminate\Http\Request;

class <?php echo $tpName; ?>Controller extends BaseController

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
->with(<?php foreach ($config['listShowFileds'] as $k => $listShowFiled) { ?><?php
        if ($k) {
            echo ',';
        }
        ?>'<?php echo $listShowFiled["withName"]; ?>'<?php } ?>)<?php } ?>;
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
        $rows[$k]['<?php echo $listShowFiled["showKey"]; ?>'] = optional(<?php echo $result; ?>-><?php echo $listShowFiled["withName"]; ?>)->pluck('<?php echo $listShowFiled["filedName"]; ?>')->toArray();
    <?php } else { ?>
        $rows[$k]['<?php echo $listShowFiled["showKey"]; ?>'] = optional(<?php echo $result; ?>-><?php echo $listShowFiled["withName"]; ?>)-><?php echo $listShowFiled["filedName"]; ?>;
    <?php   } ?>
    <?php } ?>
<?php } ?>
}

$data = [
'page' => <?php echo $results; ?>->currentPage(),
'take' => <?php echo $results; ?>->perPage(),
            'total' => <?php echo $results; ?>->total(),
            'lastPage' => <?php echo $results; ?>->lastPage(),
            'rows' => $rows,
        ];

        return $this->response('请求成功！', $data);
    }

    /**
    * <?php echo $config['tableNameCn']; ?>详情

    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        <?php echo $result ?> = <?php echo $tpName; ?>::<?php if (!empty($config['listShowFileds'][0])) { ?>with(<?php foreach ($config['listShowFileds'] as $k => $listShowFiled) { ?><?php
    if ($k) {
        echo ',';
    }
    ?>'<?php echo $listShowFiled["withName"]; ?>'<?php } ?>)-><?php } ?>findOrFail($id);

        $data = [
            '<?php echo strtolower($tpName); ?>_<?php echo $config['pk']; ?>' => <?php echo $result; ?>->id,
    <?php foreach ($config['fillable'] as $vv) { ?>
        '<?php echo $vv; ?>' => <?php echo $result; ?>-><?php echo $vv; ?>,
    <?php } ?>
    ];
<?php if (!empty($config['listShowFileds'][0])) { ?>
        <?php foreach ($config['listShowFileds'] as $listShowFiled) { ?><?php if ($listShowFiled['isPluck']) { ?>
$data['<?php echo $listShowFiled["showKey"]; ?>'] = optional(<?php echo $result; ?>-><?php echo $listShowFiled["withName"]; ?>)->pluck('<?php echo $listShowFiled["filedId"]; ?>')->toArray();
        <?php } else { ?>
$data['<?php echo $listShowFiled["showKey"]; ?>'] = optional(<?php echo $result; ?>-><?php echo $listShowFiled["withName"]; ?>)-><?php echo $listShowFiled["filedId"]; ?>;
        <?php   } ?>
        <?php } ?>
<?php } ?>

        return $this->response('请求成功！', $data);
    }

    /**
     * 添加<?php echo $config['tableNameCn']; ?>

     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request, [
            [<?php echo $config['validateRules']; ?>
        ], [
            <?php echo str_replace('-PM-',  $config['productModule'] . '_', str_replace('_k_','$',$config['validateMessages'])); ?>
        ]);

        \DB::beginTransaction();
        try {
            <?php echo $tpName; ?>::create([
        <?php foreach ($config['fillable'] as $vv) { ?>
        '<?php echo $vv; ?>' => $request-><?php echo $vv; ?>,
        <?php } ?>
        ]);

            \DB::commit();
            return $this->response('添加成功！');
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
    * 错误常量，使用过后请删除
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function validatorConst()
    {
        $const = "<?php echo str_replace('-PM-',  $config['productModule'] . '_', str_replace('_PM_','$',$config['validateConsts'])); ?>

        ";
    }

    /**
    * 错误消息，使用过后请删除
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function validatorMsg()
    {
        $msg = "<?php echo str_replace('-PM-',  $config['productModule'] . '_', str_replace('_PM_','$',$config['validateErrors'])); ?>

        ";
    }

    /**
    * 删除<?php echo $config['tableNameCn']; ?>

    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        <?php echo $tpName; ?>::findOrFail($id)->delete();
        return $this->response("删除成功");
    }
}
