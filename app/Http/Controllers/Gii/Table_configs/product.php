<?php
// 获取数据库每个字段
return [
    'tableName' => 'product',    // 表名
    'tableNameCn' => '',    // 中文名
    'author' => 'mhl', // 作者
    'moduleName' => 'A',  // 代码生成到的模块
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
            'showKey' => 'gallery_images', // 显示的key字符串
        ],
    ],
    'listSearchFileds' => [
        [
            'withName' => '', // 函数名称-表关联
            'isPTable' => 1, // 是否是主表 1、是，0不是
            'filedName' => 'title', // 字段名称
            'type' => '=', // 查询类型 =,like,in,between
            'function' => 'where', // 查询方法 where,whereIn ...
        ],
    ],
    'pk' => 'id',    // 表中主键字段名称
    'fillable' => ['category_id','location_id','brand_id','thumbnail','title','sub_title','keywords','description','price_origin','price','price_express','point_max','sale_min','sale_max','storage','unit','is_top','is_hot','is_new','is_recommend'],
    'validate' => "
                array('category_id', 'required', 'id@product_categories不能为空！', 1, 'regex', 3),
                    array('category_id', 'number', 'id@product_categories必须是一个整数！', 1, 'regex', 3),
                    array('location_id', 'number', 'id@product_locations必须是一个整数！', 2, 'regex', 3),
                    array('brand_id', 'required', 'id@product_brands不能为空！', 1, 'regex', 3),
                    array('brand_id', 'number', 'id@product_brands必须是一个整数！', 1, 'regex', 3),
                    array('thumbnail', 'required', '封面／缩略图不能为空！', 1, 'regex', 3),
                    array('thumbnail', 'max:255', '封面／缩略图的值最长不能超过 255 个字符！', 1, 'length', 3),
                    array('title', 'required', '标题不能为空！', 1, 'regex', 3),
                    array('title', 'max:255', '标题的值最长不能超过 255 个字符！', 1, 'length', 3),
                    array('sub_title', 'required', '副标题不能为空！', 1, 'regex', 3),
                    array('sub_title', 'max:255', '副标题的值最长不能超过 255 个字符！', 1, 'length', 3),
                    array('keywords', 'required', '关键词不能为空！', 1, 'regex', 3),
                    array('keywords', 'max:255', '关键词的值最长不能超过 255 个字符！', 1, 'length', 3),
                    array('description', 'required', '产品描述不能为空！', 1, 'regex', 3),
                    array('price_origin', 'required', '市场价／原价不能为空！', 1, 'regex', 3),
                    array('price', 'required', '市场价／原价不能为空！', 1, 'regex', 3),
                    array('point_max', 'number', '最大可用积分必须是一个整数！', 2, 'regex', 3),
                    array('sale_min', 'number', '起售数量必须是一个整数！', 2, 'regex', 3),
                    array('sale_max', 'number', '单次最大可售数量必须是一个整数！', 2, 'regex', 3),
                    array('storage', 'number', '商品库存必须是一个整数！', 2, 'regex', 3),
                    array('unit', 'max:255', '单位：件、份、个、箱、斤、千克、吨etc的值最长不能超过 255 个字符！', 2, 'length', 3),
                    array('is_top', 'number', '是否为置顶必须是一个整数！', 2, 'regex', 3),
                    array('is_hot', 'number', '是否为热卖必须是一个整数！', 2, 'regex', 3),
                    array('is_new', 'number', '是否为新品必须是一个整数！', 2, 'regex', 3),
                    array('is_recommend', 'number', '是否为推荐必须是一个整数！', 2, 'regex', 3),
                ",



];


