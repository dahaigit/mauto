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
            'withName' => 'galleries', // 函数名称-表关联
            'isPluck' => true,   // 是否使用pluck
            'filedName' => 'image', // 需要使用的字段
            'filedId' => 'id', // 需要使用的字段
            'showKey' => 'gallery_images', // 显示的key字符串
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
    'validate' => "
                array('keywords', 'required', '关键词不能为空！', 1, 'regex', 3),
                    array('keywords', 'max:255', '关键词的值最长不能超过 255 个字符！', 1, 'length', 3),
                    array('message', 'required', '消息不能为空！', 1, 'regex', 3),
                    array('message', 'max:255', '消息的值最长不能超过 255 个字符！', 1, 'length', 3),
                    array('is_open', 'number', '是否开启，1开启，0不开启必须是一个整数！', 2, 'regex', 3),
                ",



];


