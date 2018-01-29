namespace App\Http\Controllers\<?php echo $config['moduleName']; ?>;

use App\Models\<?php echo $tpName; ?>;
use Illuminate\Http\Request;
use App\Http\Controllers\<?php echo $config['moduleName']; ?>\<?php echo $config['baseController']; ?>;

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
<?php $results = '$'. $tpName . 's'; ?>
<?php $resultsObj = '$'. $tpName . 'sObj'; ?>
<?php $result = '$'. $tpName; ?>
        <?php echo $resultsObj; ?> = <?php echo $tpName; ?>::orderBy('<?php echo $config['pk']; ?>', 'desc')
        <?php $listShowFiledCount = count($config['listShowFileds']); ?>
<?php if ($listShowFiledCount > 0) { ?>
// 关联表
        ->with(<?php foreach ($config['listShowFileds'] as $k => $listShowFiled) { ?>'<?php echo $listShowFiled["withName"]; ?>'<?php if ($k < $listShowFiledCount - 1) {
        echo ',';
    } ?><?php } ?>)<?php } ?>;
        // 表查询
<?php foreach ($config['listSearchFileds'] as $listSearchFiled) { ?>
        <?php if ($listSearchFiled['isPTable']) { ?>
<?php echo $resultsObj; ?>->when($request-><?php echo $listSearchFiled['filedName']; ?>, function ($query) use ($request) {
                $query->where('<?php echo $listSearchFiled['filedName']; ?>', '<?php echo $listSearchFiled['type']; ?>', <?php if ($listSearchFiled['type'] == 'like') echo '"%"' . '.' ; ?>$request-><?php echo $listSearchFiled['filedName']; ?> <?php if ($listSearchFiled['type'] == 'like') echo '.' . '"%"'; ?>);
            });
        <?php } else { ?>
            if ($request-><?php echo $listSearchFiled['filedName']; ?>) {
            <?php echo $resultsObj; ?>->whereHas('<?php echo $listSearchFiled['withName']; ?>', function ($query) use ($request) {
                    $query->where('<?php echo $listSearchFiled['filedName']; ?>', '<?php echo $listSearchFiled['type']; ?>', <?php if ($listSearchFiled['type'] == 'like') echo '"%"' . '.' ; ?>$request-><?php echo $listSearchFiled['filedName']; ?> <?php if ($listSearchFiled['type'] == 'like') echo '.' . '"%"'; ?>);
                });
            }
        <?php } ?><?php } ?><?php echo $results; ?> = <?php echo $resultsObj; ?>->paginate(15);

        $rows = [];
        foreach (<?php echo $results; ?> as $k => <?php echo $result; ?>) {
            $rows[$k] = [
                    '<?php echo strtolower($tpName); ?>_<?php echo $config['pk']; ?>' => <?php echo $result; ?>->id,
        <?php foreach ($config['fillable'] as $vv) { ?>
            '<?php echo $vv; ?>' => <?php echo $result; ?>-><?php echo $vv; ?>,
        <?php } ?>
        ];
            // 关联字段
    <?php foreach ($config['listShowFileds'] as $listShowFiled) { ?><?php if ($listShowFiled['isPluck']) { ?>
        $row[$k]['<?php echo $listShowFiled["showKey"]; ?>'] = <?php echo $result; ?>-><?php echo $listShowFiled["withName"]; ?>->pluck('<?php echo $listShowFiled["filedName"]; ?>')->toArray() ?? 0;
    <?php } else { ?>
        $row[$k]['<?php echo $listShowFiled["showKey"]; ?>'] = <?php echo $result; ?>-><?php echo $listShowFiled["withName"]; ?>-><?php echo $listShowFiled["filedName"]; ?> ?? 0;
    <?php   } ?>
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
     * 获取创建页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('club.add');
    }

    /**
     * 保存添加内容
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            'city_name' => 'required',
            'city_code' => 'required',
            'club_name' => 'required',
        ], [
            'city_name.required' => '城市名称必须填。',
            'city_code.required' => '城市区号代码必须填。',
            'club_name.required' => '会所名字必须填。'
        ])->validate();

        $club = Club::orderBy('id', 'desc')->select('club_code')->first();

        $club_code = (int)$club->club_code + 1;

        Club::create([
            'city_name' => $request->old('city_name'),
            'city_code' => $request->old('city_code'),
            'club_name' => $request->old('club_name'),
            'club_code' => $club_code,
        ]);

        return \Redirect::back()->withInput()->withErrors("添加成功");
    }

}
