<?php
// 获取数据库每个字段
return [
    'tableName' => 'orders_rebate_record',    // 表名
    'tableNameCn' => '订单佣金记录',    // 中文名
    'productModule' => 'Babysitter',
    'author' => '孟海龙', // 作者
    'moduleName' => 'API',  // 代码生成到的模块
    'baseController' => 'ApiController', // 默认base控制器
    'withTables' => [ // 关系表
    //     [
    //        'withName' => 'galleries', // 函数名称-表关联
    //        'tableName' => 'product_galleries',
    //        'tableNameCn' => '相册',  // 关联表名称
    //        'relation' => '1_n', // 关系
    //        'return' => 'return $this->hasMany(ProductGallery::class)', // 返回字符串
    //   ],
    ],
    'listShowFileds' => [ // 列表页需要显示的关联字段
        [
            //'withName' => 'galleries', // 函数名称-表关联
            //'isPluck' => true,   // 是否使用pluck
            //'filedName' => 'image', // 需要使用的字段
            //'filedId' => 'id', // 需要使用的字段
            //'showKey' => 'gallery_images', // 显示的key字符串
        ],
    ],
    'listSearchFileds' => [
        [
            //'withName' => '', // 函数名称-表关联
            //'isPTable' => 1, // 是否是主表 1、是，0不是
            //'filedName' => 'title', // 字段名称
            //'type' => '=', // 查询类型 =,like,in,between
            //'function' => 'where', // 查询方法 where,whereIn ...
        ],
    ],
        'pk' => 'id',    // 表中主键字段名称
    'fillable' => ['invite_code','id_code','cart_id','order_id','status','babysitter_rebate','remark','company_rebate','company_code'],
        'validateConsts' => "
const E_-PM-ORDERS_REBATE_RECORD_INVITE_CODE_NOT_EMPTY = 100000;
const E_-PM-ORDERS_REBATE_RECORD_INVITE_CODE_MAX = 100001;
const E_-PM-ORDERS_REBATE_RECORD_ID_CODE_NOT_EMPTY = 100002;
const E_-PM-ORDERS_REBATE_RECORD_ID_CODE_MAX = 100003;
const E_-PM-ORDERS_REBATE_RECORD_CART_ID_NOT_NUMERIC = 100004;
const E_-PM-ORDERS_REBATE_RECORD_ORDER_ID_NOT_NUMERIC = 100005;
const E_-PM-ORDERS_REBATE_RECORD_STATUS_NOT_IN = 100006;
const E_-PM-ORDERS_REBATE_RECORD_BABYSITTER_REBATE_NOT_EMPTY = 100007;
const E_-PM-ORDERS_REBATE_RECORD_REMARK_MAX = 100008;
const E_-PM-ORDERS_REBATE_RECORD_COMPANY_REBATE_NOT_EMPTY = 100009;
const E_-PM-ORDERS_REBATE_RECORD_COMPANY_CODE_MAX = 100010;",
    'validateErrors' => "
Code::E_-PM-ORDERS_REBATE_RECORD_INVITE_CODE_NOT_EMPTY => '保姆邀请码不能为空！',
Code::E_-PM-ORDERS_REBATE_RECORD_INVITE_CODE_MAX => '保姆邀请码不能超过255个字符',
Code::E_-PM-ORDERS_REBATE_RECORD_ID_CODE_NOT_EMPTY => '宝妈唯一标识码不能为空！',
Code::E_-PM-ORDERS_REBATE_RECORD_ID_CODE_MAX => '宝妈唯一标识码不能超过255个字符',
Code::E_-PM-ORDERS_REBATE_RECORD_CART_ID_NOT_NUMERIC => '购物车ID @carts.id必须是一个数字',
Code::E_-PM-ORDERS_REBATE_RECORD_ORDER_ID_NOT_NUMERIC => '订单ID @orders.id必须是一个数字',
Code::E_-PM-ORDERS_REBATE_RECORD_STATUS_NOT_IN => '是否有效：0无效，1有效',
Code::E_-PM-ORDERS_REBATE_RECORD_BABYSITTER_REBATE_NOT_EMPTY => '月嫂佣金不能为空！',
Code::E_-PM-ORDERS_REBATE_RECORD_REMARK_MAX => '原因不能超过255个字符',
Code::E_-PM-ORDERS_REBATE_RECORD_COMPANY_REBATE_NOT_EMPTY => '月嫂中心佣金不能为空！',
Code::E_-PM-ORDERS_REBATE_RECORD_COMPANY_CODE_MAX => '机构唯一标识码不能超过255个字符',",
    'validateRules' => "
'invite_code' => 'required|max:255',
'id_code' => 'required|max:255',
'cart_id' => 'numeric',
'order_id' => 'numeric',
'status' => 'in',
'babysitter_rebate' => 'required',
'remark' => 'max:255',
'company_rebate' => 'required',
'company_code' => 'max:255',",
    'validateMessages' => "
'invite_code.required' => Code::E_-PM-ORDERS_REBATE_RECORD_INVITE_CODE_NOT_EMPTY,
'invite_code.max' => Code::E_-PM-ORDERS_REBATE_RECORD_INVITE_CODE_MAX,
'id_code.required' => Code::E_-PM-ORDERS_REBATE_RECORD_ID_CODE_NOT_EMPTY,
'id_code.max' => Code::E_-PM-ORDERS_REBATE_RECORD_ID_CODE_MAX,
'cart_id.numeric' => Code::E_-PM-ORDERS_REBATE_RECORD_CART_ID_NOT_NUMERIC,
'order_id.numeric' => Code::E_-PM-ORDERS_REBATE_RECORD_ORDER_ID_NOT_NUMERIC,
'status.in:0,1' => Code::E_-PM-ORDERS_REBATE_RECORD_STATUS_NOT_IN,
'babysitter_rebate.required' => Code::E_-PM-ORDERS_REBATE_RECORD_BABYSITTER_REBATE_NOT_EMPTY,
'remark.max' => Code::E_-PM-ORDERS_REBATE_RECORD_REMARK_MAX,
'company_rebate.required' => Code::E_-PM-ORDERS_REBATE_RECORD_COMPANY_REBATE_NOT_EMPTY,
'company_code.max' => Code::E_-PM-ORDERS_REBATE_RECORD_COMPANY_CODE_MAX,",



];



