<?php
namespace App\Http\Controllers\Admin;

use App\Models\WechatMessage;
use Illuminate\Http\Request;

class WechatMessageController extends ApiController
{
    /**
     * 微信消息回复列表
     * author  mhl,
     * date    2018-01-31 02:22:35,
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $wechatMessageBuilder = WechatMessage::orderBy('id', 'desc');
        $wechatMessages = $wechatMessageBuilder->paginate(15);

        $rows = [];
        foreach ($wechatMessages as $k => $wechatMessage) {
            $rows[$k] = [
                    'wechatmessage_id' => $wechatMessage->id,
                    'keywords' => $wechatMessage->keywords,
                    'message' => $wechatMessage->message,
                    'is_open' => $wechatMessage->is_open,
                ];
        }

        $data = [
            'currentPage' => $wechatMessages->currentPage(),
            'perPage' => $wechatMessages->perPage(),
            'total' => $wechatMessages->total(),
            'lastPage' => $wechatMessages->lastPage(),
            'rows' => $rows,
        ];

        return $this->apiResponse('请求成功！', R_OK, $data);
    }

    /**
    * 微信消息回复详情
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $wechatMessage = WechatMessage::findOrFail($id);

        $data = [];
        $data = [
            'wechatmessage_id' => $wechatMessage->id,
            'keywords' => $wechatMessage->keywords,
            'message' => $wechatMessage->message,
            'is_open' => $wechatMessage->is_open,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
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

    /**
    * 删除微信消息回复
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        WechatMessage::where('id', $id)->delete();
        return $this->apiResponse("删除成功", Code::R_OK);
    }

}
