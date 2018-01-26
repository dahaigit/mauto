namespace App\Http\Controllers\<?php echo $config['moduleName']; ?>;

use App\Models\<?php $tpName ?>;
use Illuminate\Http\Request;
use App\Http\Controllers\<?php echo $config['moduleName']; ?>\WebController;


class <?php $tpName ?>Controller extends WebController
{
    /**
     * 会所列表
     * author  mhl
     * date    2018-01-25
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clubs = <?php $tpName ?>::orderBy('id', 'desc')->paginate(15);

        return view('admin.club.index', compact('clubs'));
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
