<?php
// 获取数据库每个字段
return [
    'tableName' => 'product_galleries',    // 表名
    'tableNameCn' => '',    // 中文名
    'author' => 'mhl', // 作者
    'moduleName' => 'Admin',  // 代码生成到的模块
    'baseController' => 'ApiController', // 默认base控制器
    'withTables' => [ // 关系表

    ],
    'listShowFileds' => [ // 列表页需要显示的关联字段

    ],
    'listSearchFileds' => [

    ],
    'fields' => [
            'id' => [
                'text' => '',
                'type' => 'double',
                'default' => '',
            ],
            'product_id' => [
                'text' => '',
                'type' => 'double',
                'default' => '',
            ],
            'image' => [
                'text' => '',
                'type' => 'varchar(765)',
                'default' => '',
            ],
            'deleted_at' => [
                'text' => '',
                'type' => 'timestamp',
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'created_at' => [
                'text' => '',
                'type' => 'timestamp',
                'default' => '0000-00-00 00:00:00',
            ],
            'updated_at' => [
                'text' => '',
                'type' => 'timestamp',
                'default' => '0000-00-00 00:00:00',
            ],
        ],
        'pk' => 'id',    // 表中主键字段名称
        'fillable' => ['id','product_id','image'],




];


