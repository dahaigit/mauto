<?php
namespace App\Http\Controllers\API;

use App\Models\WechatMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController;

class WechatMessageController extends ApiController
{
    /**
     * 微信消息回复列表
     * author  mhl,
     * date    2018-01-30 08:42:04,
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $WechatMessagesObj = WechatMessage::orderBy('id', 'desc')
        // 关联表
        ->with('galleries');
        // 表查询
        if ($request->title) {
            $WechatMessagesObj->whereHas('', function ($query) use ($request) {
                    $query->where('title', '=', $request->title );
                });
        }
        $WechatMessages = $WechatMessagesObj->paginate(15);

        $rows = [];
        foreach ($WechatMessages as $k => $WechatMessage) {
            $rows[$k] = [
                    'wechatmessage_id' => $WechatMessage->id,
                    'keywords' => $WechatMessage->keywords,
                    'message' => $WechatMessage->message,
                    'is_open' => $WechatMessage->is_open,
                ];
            // 关联字段
            $row[$k]['gallery_images'] = $WechatMessage->galleries->pluck('image')->toArray() ?? 0;
        }

        $data = [
            'currentPage' => $WechatMessages->currentPage(),
            'perPage' => $WechatMessages->perPage(),
            'total' => $WechatMessages->total(),
            'lastPage' => $WechatMessages->lastPage(),
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
        return view('api.wechatmessage.add');
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
