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
    public function index()
    {
<?php $results = '$'. $tpName . 's'; ?>
<?php $result = '$'. $tpName; ?>
        <?php echo $results; ?> = <?php echo $tpName; ?>::orderBy('id', 'desc')
        ->paginate(15);

        $rows = [];
        foreach (<?php echo $results; ?> as $k => <?php echo $result; ?>) {
            $rows[] = [
                    '<?php echo strtolower($tpName); ?>_id' => <?php echo $result; ?>->id,
        <?php foreach ($config['fillable'] as $vv) { ?>
            '<?php echo $vv; ?>' => <?php echo $result; ?>-><?php echo $vv; ?>,
        <?php } ?>
        ];
        }
        $data = [
            'currentPage' => <?php echo $results; ?>->currentPage(),
            'perPage' => <?php echo $results; ?>->perPage(),
            'total' => <?php echo $results; ?>->total(),
            'lastPage' => <?php echo $results; ?>->lastPage(),
            'rows' => $rows
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
