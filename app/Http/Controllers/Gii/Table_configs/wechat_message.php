<?php
// 获取数据库每个字段
return [
    'tableName' => 'wechat_message',    // 表名
    'tableNameCn' => '微信消息回复',    // 中文名
    'productModule' => 'PRODUCT',
    'author' => 'mhl', // 作者
    'moduleName' => 'API',  // 代码生成到的模块
    'baseController' => 'ApiController', // 默认base控制器
    'withTables' => [ // 关系表
         [
            'withName' => 'galleries', // 函数名称-表关联
            'tableName' => 'product_galleries',
            'tableNameCn' => '相册',  // 关联表名称
            'relation' => '1_n', // 关系
            'return' => 'return $this->hasMany(ProductGallery::class)', // 返回字符串
        ],
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
    'fillable' => ['keywords','message','is_open'],
        'validateConsts' => "
const E_-PM-WECHAT_MESSAGE_KEYWORDS_NOT_EMPTY = 1;
const E_-PM-WECHAT_MESSAGE_KEYWORDS_MAX = 2;
const E_-PM-WECHAT_MESSAGE_MESSAGE_NOT_EMPTY = 3;
const E_-PM-WECHAT_MESSAGE_MESSAGE_MAX = 4;
const E_-PM-WECHAT_MESSAGE_IS_OPEN_NOT_IN = 5;",
    'validateErrors' => "
Code::E_-PM-WECHAT_MESSAGE_KEYWORDS_NOT_EMPTY => '关键词不能为空！',
Code::E_-PM-WECHAT_MESSAGE_KEYWORDS_MAX => '关键词的值最长不能超过255',
Code::E_-PM-WECHAT_MESSAGE_MESSAGE_NOT_EMPTY => '消息不能为空！',
Code::E_-PM-WECHAT_MESSAGE_MESSAGE_MAX => '消息的值最长不能超过255',
Code::E_-PM-WECHAT_MESSAGE_IS_OPEN_NOT_IN => '是否开启，1开启，0不开启',",
    'validateRules' => "
'keywords' => 'required|max:255',
'message' => 'required|max:255',
'is_open' => 'in',",
    'validateMessages' => "
'keywords.required' => _k_this->ruleMsg(Code::E_-PM-WECHAT_MESSAGE_KEYWORDS_NOT_EMPTY),
'keywords.max' => _k_this->ruleMsg(Code::E_-PM-WECHAT_MESSAGE_KEYWORDS_MAX),
'message.required' => _k_this->ruleMsg(Code::E_-PM-WECHAT_MESSAGE_MESSAGE_NOT_EMPTY),
'message.max' => _k_this->ruleMsg(Code::E_-PM-WECHAT_MESSAGE_MESSAGE_MAX),
'is_open.in:0,1' => _k_this->ruleMsg(Code::E_-PM-WECHAT_MESSAGE_IS_OPEN_NOT_IN),",



];



