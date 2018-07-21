<?php
namespace App\Http\Controllers\API\Babysitter;

use App\Models\OrdersRebateRecord;
use App\Common\Contract\Code;
use App\Http\Controllers\API\ApiController;
use Illuminate\Http\Request;

class OrdersRebateRecordController extends ApiController
{
/**
* 订单佣金记录列表
* author  孟海龙,
* date    2018-07-16 15:23:44,
* @return \Illuminate\Http\Response
*/
public function index(Request $request)
{
        $ordersRebateRecordBuilder = OrdersRebateRecord::orderBy('id', 'desc');
        $ordersRebateRecords = $ordersRebateRecordBuilder->paginate(15);

        $rows = [];
        foreach ($ordersRebateRecords as $k => $ordersRebateRecord) {
            $rows[$k] = [
                    'ordersrebaterecord_id' => $ordersRebateRecord->id,
    'invite_code' => $ordersRebateRecord->invite_code,
    'id_code' => $ordersRebateRecord->id_code,
    'cart_id' => $ordersRebateRecord->cart_id,
    'order_id' => $ordersRebateRecord->order_id,
    'status' => $ordersRebateRecord->status,
    'babysitter_rebate' => $ordersRebateRecord->babysitter_rebate,
    'remark' => $ordersRebateRecord->remark,
    'company_rebate' => $ordersRebateRecord->company_rebate,
];
}

$data = [
'page' => $ordersRebateRecords->currentPage(),
'take' => $ordersRebateRecords->perPage(),
            'total' => $ordersRebateRecords->total(),
            'lastPage' => $ordersRebateRecords->lastPage(),
            'rows' => $rows,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
    * 订单佣金记录详情

    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $ordersRebateRecord = OrdersRebateRecord::findOrFail($id);

        $data = [
            'ordersrebaterecord_id' => $ordersRebateRecord->id,
            'invite_code' => $ordersRebateRecord->invite_code,
            'id_code' => $ordersRebateRecord->id_code,
            'cart_id' => $ordersRebateRecord->cart_id,
            'order_id' => $ordersRebateRecord->order_id,
            'status' => $ordersRebateRecord->status,
            'babysitter_rebate' => $ordersRebateRecord->babysitter_rebate,
            'remark' => $ordersRebateRecord->remark,
            'company_rebate' => $ordersRebateRecord->company_rebate,
        ];

        return $this->apiResponse('请求成功！', Code::R_OK, $data);
    }

    /**
     * 添加订单佣金记录
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
'invite_code' => 'required|max:255',
'id_code' => 'required|max:255',
'cart_id' => 'numeric',
'order_id' => 'numeric',
'status' => 'in',
'babysitter_rebate' => 'required',
'remark' => 'max:255',
'company_rebate' => 'required',
        ], [
'invite_code.required' => Code::E_Babysitter_ORDERS_REBATE_RECORD_INVITE_CODE_NOT_EMPTY,
'invite_code.max' => Code::E_Babysitter_ORDERS_REBATE_RECORD_INVITE_CODE_MAX,
'id_code.required' => Code::E_Babysitter_ORDERS_REBATE_RECORD_ID_CODE_NOT_EMPTY,
'id_code.max' => Code::E_Babysitter_ORDERS_REBATE_RECORD_ID_CODE_MAX,
'cart_id.numeric' => Code::E_Babysitter_ORDERS_REBATE_RECORD_CART_ID_NOT_NUMERIC,
'order_id.numeric' => Code::E_Babysitter_ORDERS_REBATE_RECORD_ORDER_ID_NOT_NUMERIC,
'status.in:0,1' => Code::E_Babysitter_ORDERS_REBATE_RECORD_STATUS_NOT_IN,
'babysitter_rebate.required' => Code::E_Babysitter_ORDERS_REBATE_RECORD_BABYSITTER_REBATE_NOT_EMPTY,
'remark.max' => Code::E_Babysitter_ORDERS_REBATE_RECORD_REMARK_MAX,
'company_rebate.required' => Code::E_Babysitter_ORDERS_REBATE_RECORD_COMPANY_REBATE_NOT_EMPTY,
        ])->validate();

        \DB::beginTransaction();
        try {
            OrdersRebateRecord::create([
                'invite_code' => $request->invite_code,
                'id_code' => $request->id_code,
                'cart_id' => $request->cart_id,
                'order_id' => $request->order_id,
                'status' => $request->status,
                'babysitter_rebate' => $request->babysitter_rebate,
                'remark' => $request->remark,
                'company_rebate' => $request->company_rebate,
                ]);

            \DB::commit();
            return $this->apiResponse('添加成功！', Code::R_OK);
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
        $const = "
const E_Babysitter_ORDERS_REBATE_RECORD_INVITE_CODE_NOT_EMPTY = 100000;
const E_Babysitter_ORDERS_REBATE_RECORD_INVITE_CODE_MAX = 100001;
const E_Babysitter_ORDERS_REBATE_RECORD_ID_CODE_NOT_EMPTY = 100002;
const E_Babysitter_ORDERS_REBATE_RECORD_ID_CODE_MAX = 100003;
const E_Babysitter_ORDERS_REBATE_RECORD_CART_ID_NOT_NUMERIC = 100004;
const E_Babysitter_ORDERS_REBATE_RECORD_ORDER_ID_NOT_NUMERIC = 100005;
const E_Babysitter_ORDERS_REBATE_RECORD_STATUS_NOT_IN = 100006;
const E_Babysitter_ORDERS_REBATE_RECORD_BABYSITTER_REBATE_NOT_EMPTY = 100007;
const E_Babysitter_ORDERS_REBATE_RECORD_REMARK_MAX = 100008;
const E_Babysitter_ORDERS_REBATE_RECORD_COMPANY_REBATE_NOT_EMPTY = 100009;
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
        $msg = "
Code::E_Babysitter_ORDERS_REBATE_RECORD_INVITE_CODE_NOT_EMPTY => '保姆邀请码不能为空！',
Code::E_Babysitter_ORDERS_REBATE_RECORD_INVITE_CODE_MAX => '保姆邀请码不能超过255个字符',
Code::E_Babysitter_ORDERS_REBATE_RECORD_ID_CODE_NOT_EMPTY => '宝妈唯一标识码不能为空！',
Code::E_Babysitter_ORDERS_REBATE_RECORD_ID_CODE_MAX => '宝妈唯一标识码不能超过255个字符',
Code::E_Babysitter_ORDERS_REBATE_RECORD_CART_ID_NOT_NUMERIC => '购物车ID @carts.id必须是一个数字',
Code::E_Babysitter_ORDERS_REBATE_RECORD_ORDER_ID_NOT_NUMERIC => '订单ID @orders.id必须是一个数字',
Code::E_Babysitter_ORDERS_REBATE_RECORD_STATUS_NOT_IN => '是否有效：0无效，1有效',
Code::E_Babysitter_ORDERS_REBATE_RECORD_BABYSITTER_REBATE_NOT_EMPTY => '月嫂佣金不能为空！',
Code::E_Babysitter_ORDERS_REBATE_RECORD_REMARK_MAX => '原因不能超过255个字符',
Code::E_Babysitter_ORDERS_REBATE_RECORD_COMPANY_REBATE_NOT_EMPTY => '月嫂中心佣金不能为空！',
        ";
    }

    /**
    * 删除订单佣金记录
    *
    * @param  int $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        OrdersRebateRecord::where('id', $id)->delete();
        return $this->apiResponse("删除成功", Code::R_OK);
    }
}
