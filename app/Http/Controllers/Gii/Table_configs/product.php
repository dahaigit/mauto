<?php
// 获取数据库每个字段
return [
    'tableName' => 'product',    // 表名
    'tableNameCn' => '',    // 中文名
    'author' => 'mhl', // 作者
    'moduleName' => 'Admin',  // 代码生成到的模块
    'baseController' => 'ApiController', // 默认base控制器
    'fields' => [
            'id' => [
                'text' => '',
                'type' => 'int(10) unsigned',
                'default' => '',
            ],
            'category_id' => [
                'text' => 'id@product_categories',
                'type' => 'int(10) unsigned',
                'default' => '',
            ],
            'location_id' => [
                'text' => 'id@product_locations',
                'type' => 'int(10) unsigned',
                'default' => '1',
            ],
            'brand_id' => [
                'text' => 'id@product_brands',
                'type' => 'int(10) unsigned',
                'default' => '',
            ],
            'thumbnail' => [
                'text' => '封面／缩略图',
                'type' => 'varchar(255)',
                'default' => '',
            ],
            'title' => [
                'text' => '标题',
                'type' => 'varchar(255)',
                'default' => '',
            ],
            'sub_title' => [
                'text' => '副标题',
                'type' => 'varchar(255)',
                'default' => '',
            ],
            'keywords' => [
                'text' => '关键词',
                'type' => 'varchar(255)',
                'default' => '',
            ],
            'description' => [
                'text' => '产品描述',
                'type' => 'text',
                'default' => '',
            ],
            'price_origin' => [
                'text' => '市场价／原价',
                'type' => 'double(8,2)',
                'default' => '',
            ],
            'price' => [
                'text' => '市场价／原价',
                'type' => 'double(8,2)',
                'default' => '',
            ],
            'price_express' => [
                'text' => '快递价',
                'type' => 'double(8,2)',
                'default' => '10.00',
            ],
            'point_max' => [
                'text' => '最大可用积分',
                'type' => 'int(10) unsigned',
                'default' => '0',
            ],
            'sale_min' => [
                'text' => '起售数量',
                'type' => 'int(10) unsigned',
                'default' => '1',
            ],
            'sale_max' => [
                'text' => '单次最大可售数量',
                'type' => 'int(10) unsigned',
                'default' => '10',
            ],
            'storage' => [
                'text' => '商品库存',
                'type' => 'int(10) unsigned',
                'default' => '999',
            ],
            'unit' => [
                'text' => '单位：件、份、个、箱、斤、千克、吨etc',
                'type' => 'varchar(255)',
                'default' => '份',
            ],
            'is_top' => [
                'text' => '是否为置顶',
                'type' => 'tinyint(1)',
                'default' => '0',
            ],
            'is_hot' => [
                'text' => '是否为热卖',
                'type' => 'tinyint(1)',
                'default' => '0',
            ],
            'is_new' => [
                'text' => '是否为新品',
                'type' => 'tinyint(1)',
                'default' => '0',
            ],
            'is_recommend' => [
                'text' => '是否为推荐',
                'type' => 'tinyint(1)',
                'default' => '0',
            ],
            'deleted_at' => [
                'text' => '软删除',
                'type' => 'timestamp',
                'default' => '',
            ],
            'created_at' => [
                'text' => '',
                'type' => 'timestamp',
                'default' => '',
            ],
            'updated_at' => [
                'text' => '',
                'type' => 'timestamp',
                'default' => '',
            ],
        ],
            'fillable' => ['category_id','location_id','brand_id','thumbnail','title','sub_title','keywords','description','price_origin','price','price_express','point_max','sale_min','sale_max','storage','unit','is_top','is_hot','is_new','is_recommend'],




];


