<?php
// 获取数据库每个字段
return [
    'tableName' => 'wechat_message',    // 表名
    'tableNameCn' => '微信消息回复',    // 中文名
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
    'validateConst' => "
CONST E_V_MODULE_WECHAT_MESSAGE_KEYWORDS_NOT_EMPTY = 1;
CONST E_V_MODULE_WECHAT_MESSAGE_KEYWORDS_MAX = 2;
CONST E_V_MODULE_WECHAT_MESSAGE_MESSAGE_NOT_EMPTY = 3;
CONST E_V_MODULE_WECHAT_MESSAGE_MESSAGE_MAX = 4;
CONST E_V_MODULE_WECHAT_MESSAGE_IS_OPEN_NOT_IN = 5;",
    'validateErrors' => "Code::E_WECHAT_MESSAGE_KEYWORDS_EMPTY => '关键词不能为空！',
                        Code::E_WECHAT_MESSAGE_KEYWORDS_MAX => '关键词的值最长不能超过:max个字符！',
                        Code::E_WECHAT_MESSAGE_MESSAGE_EMPTY => '消息不能为空！',
                        Code::E_WECHAT_MESSAGE_MESSAGE_MAX => '消息的值最长不能超过:max个字符！',
                        Code::E_WECHAT_MESSAGE_IS_OPEN_EMPTY => '是否开发不能为空！',
                        Code::E_WECHAT_MESSAGE_IS_OPEN_IN => '是否开放必须选择 1,2 其中一个！',",
    'validateRules' => "'keywords' => 'required',
                        'message' => 'required',
                        'is_open' => 'required|in:1,2',",
    'validateMessages' => "'keywords.required' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_KEYWORDS_EMPTY),
                        'message.required' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_MESSAGE_EMPTY),
                        'is_open.required' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_IS_OPEN_EMPTY),
                        'is_open.in' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_IS_OPEN_IN),",



];



