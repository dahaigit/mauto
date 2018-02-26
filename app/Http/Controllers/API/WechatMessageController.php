<?php
namespace App\Http\Controllers\API;

use App\Models\WechatMessage;
use BenbenLand\Contracts\Code;
use Illuminate\Http\Request;

class WechatMessageController extends ApiController
{
    /**
     * 微信消息回复列表
     * author  mhl,
     * date    2018-02-02 02:40:36,
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

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
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

        $data = [
            'wechatmessage_id' => $wechatMessage->id,
            'keywords' => $wechatMessage->keywords,
            'message' => $wechatMessage->message,
            'is_open' => $wechatMessage->is_open,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
     * 添加微信消息回复
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
'keywords' => 'required|max:255',
'message' => 'required|max:255',
'is_open' => 'in',        ], [
            
'keywords.required' => $this->ruleMsg(Code::E_PRODUCT_WECHAT_MESSAGE_KEYWORDS_NOT_EMPTY),
'keywords.max' => $this->ruleMsg(Code::E_PRODUCT_WECHAT_MESSAGE_KEYWORDS_MAX),
'message.required' => $this->ruleMsg(Code::E_PRODUCT_WECHAT_MESSAGE_MESSAGE_NOT_EMPTY),
'message.max' => $this->ruleMsg(Code::E_PRODUCT_WECHAT_MESSAGE_MESSAGE_MAX),
'is_open.in:0,1' => $this->ruleMsg(Code::E_PRODUCT_WECHAT_MESSAGE_IS_OPEN_NOT_IN),        ]);
        $this->validatorErrors($validator);

        \DB::beginTransaction();
        try {
            WechatMessage::create([
                'keywords' => $request->keywords,
                'message' => $request->message,
                'is_open' => $request->is_open,
                ]);

            \DB::commit();
            return $this->apiResponse('添加成功！', Code::R_OK);
        } catch (\Exception $e) {
            \DB::rollBack();
            dd($e);
        }
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
