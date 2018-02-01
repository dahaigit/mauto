<?php
// 获取数据库每个字段
return [
    'tableName' => 'product',    // 表名
    'tableNameCn' => '',    // 中文名
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
    'fillable' => ['category_id','location_id','brand_id','thumbnail','title','sub_title','keywords','description','price_origin','price','price_express','point_max','sale_min','sale_max','storage','unit','is_top','is_hot','is_new','is_recommend'],
        'validateConsts' => "
const E_-PM-PRODUCT_CATEGORY_ID_NOT_EMPTY = 1;
const E_-PM-PRODUCT_CATEGORY_ID_NOT_NUMERIC = 2;
const E_-PM-PRODUCT_LOCATION_ID_NOT_NUMERIC = 3;
const E_-PM-PRODUCT_BRAND_ID_NOT_EMPTY = 4;
const E_-PM-PRODUCT_BRAND_ID_NOT_NUMERIC = 5;
const E_-PM-PRODUCT_THUMBNAIL_NOT_EMPTY = 6;
const E_-PM-PRODUCT_THUMBNAIL_MAX = 7;
const E_-PM-PRODUCT_TITLE_NOT_EMPTY = 8;
const E_-PM-PRODUCT_TITLE_MAX = 9;
const E_-PM-PRODUCT_SUB_TITLE_NOT_EMPTY = 10;
const E_-PM-PRODUCT_SUB_TITLE_MAX = 11;
const E_-PM-PRODUCT_KEYWORDS_NOT_EMPTY = 12;
const E_-PM-PRODUCT_KEYWORDS_MAX = 13;
const E_-PM-PRODUCT_DESCRIPTION_NOT_EMPTY = 14;
const E_-PM-PRODUCT_PRICE_ORIGIN_NOT_EMPTY = 15;
const E_-PM-PRODUCT_PRICE_NOT_EMPTY = 16;
const E_-PM-PRODUCT_POINT_MAX_NOT_NUMERIC = 17;
const E_-PM-PRODUCT_SALE_MIN_NOT_NUMERIC = 18;
const E_-PM-PRODUCT_SALE_MAX_NOT_NUMERIC = 19;
const E_-PM-PRODUCT_STORAGE_NOT_NUMERIC = 20;
const E_-PM-PRODUCT_UNIT_MAX = 21;
const E_-PM-PRODUCT_IS_TOP_NOT_IN = 22;
const E_-PM-PRODUCT_IS_HOT_NOT_IN = 23;
const E_-PM-PRODUCT_IS_NEW_NOT_IN = 24;
const E_-PM-PRODUCT_IS_RECOMMEND_NOT_IN = 25;",
    'validateErrors' => "
Code::E_-PM-PRODUCT_CATEGORY_ID_NOT_EMPTY => 'id@product_categories不能为空！',
Code::E_-PM-PRODUCT_CATEGORY_ID_NOT_NUMERIC => 'id@product_categories必须是一个数字',
Code::E_-PM-PRODUCT_LOCATION_ID_NOT_NUMERIC => 'id@product_locations必须是一个数字',
Code::E_-PM-PRODUCT_BRAND_ID_NOT_EMPTY => 'id@product_brands不能为空！',
Code::E_-PM-PRODUCT_BRAND_ID_NOT_NUMERIC => 'id@product_brands必须是一个数字',
Code::E_-PM-PRODUCT_THUMBNAIL_NOT_EMPTY => '封面／缩略图不能为空！',
Code::E_-PM-PRODUCT_THUMBNAIL_MAX => '封面／缩略图的值最长不能超过255',
Code::E_-PM-PRODUCT_TITLE_NOT_EMPTY => '标题不能为空！',
Code::E_-PM-PRODUCT_TITLE_MAX => '标题的值最长不能超过255',
Code::E_-PM-PRODUCT_SUB_TITLE_NOT_EMPTY => '副标题不能为空！',
Code::E_-PM-PRODUCT_SUB_TITLE_MAX => '副标题的值最长不能超过255',
Code::E_-PM-PRODUCT_KEYWORDS_NOT_EMPTY => '关键词不能为空！',
Code::E_-PM-PRODUCT_KEYWORDS_MAX => '关键词的值最长不能超过255',
Code::E_-PM-PRODUCT_DESCRIPTION_NOT_EMPTY => '产品描述不能为空！',
Code::E_-PM-PRODUCT_PRICE_ORIGIN_NOT_EMPTY => '市场价／原价不能为空！',
Code::E_-PM-PRODUCT_PRICE_NOT_EMPTY => '市场价／原价不能为空！',
Code::E_-PM-PRODUCT_POINT_MAX_NOT_NUMERIC => '最大可用积分必须是一个数字',
Code::E_-PM-PRODUCT_SALE_MIN_NOT_NUMERIC => '起售数量必须是一个数字',
Code::E_-PM-PRODUCT_SALE_MAX_NOT_NUMERIC => '单次最大可售数量必须是一个数字',
Code::E_-PM-PRODUCT_STORAGE_NOT_NUMERIC => '商品库存必须是一个数字',
Code::E_-PM-PRODUCT_UNIT_MAX => '单位：件、份、个、箱、斤、千克、吨etc的值最长不能超过255',
Code::E_-PM-PRODUCT_IS_TOP_NOT_IN => '是否为置顶',
Code::E_-PM-PRODUCT_IS_HOT_NOT_IN => '是否为热卖',
Code::E_-PM-PRODUCT_IS_NEW_NOT_IN => '是否为新品',
Code::E_-PM-PRODUCT_IS_RECOMMEND_NOT_IN => '是否为推荐',",
    'validateRules' => "
'category_id' => 'required|numeric',
'location_id' => 'numeric',
'brand_id' => 'required|numeric',
'thumbnail' => 'required|max:255',
'title' => 'required|max:255',
'sub_title' => 'required|max:255',
'keywords' => 'required|max:255',
'description' => 'required',
'price_origin' => 'required',
'price' => 'required',
'point_max' => 'numeric',
'sale_min' => 'numeric',
'sale_max' => 'numeric',
'storage' => 'numeric',
'unit' => 'max:255',
'is_top' => 'in:0,1',
'is_hot' => 'in:0,1',
'is_new' => 'in:0,1',
'is_recommend' => 'in:0,1',",
    'validateMessages' => "
'category_id.required' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_CATEGORY_ID_NOT_EMPTY),
'category_id.numeric' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_CATEGORY_ID_NOT_NUMERIC),
'location_id.numeric' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_LOCATION_ID_NOT_NUMERIC),
'brand_id.required' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_BRAND_ID_NOT_EMPTY),
'brand_id.numeric' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_BRAND_ID_NOT_NUMERIC),
'thumbnail.required' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_THUMBNAIL_NOT_EMPTY),
'thumbnail.max' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_THUMBNAIL_MAX),
'title.required' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_TITLE_NOT_EMPTY),
'title.max' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_TITLE_MAX),
'sub_title.required' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_SUB_TITLE_NOT_EMPTY),
'sub_title.max' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_SUB_TITLE_MAX),
'keywords.required' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_KEYWORDS_NOT_EMPTY),
'keywords.max' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_KEYWORDS_MAX),
'description.required' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_DESCRIPTION_NOT_EMPTY),
'price_origin.required' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_PRICE_ORIGIN_NOT_EMPTY),
'price.required' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_PRICE_NOT_EMPTY),
'point_max.numeric' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_POINT_MAX_NOT_NUMERIC),
'sale_min.numeric' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_SALE_MIN_NOT_NUMERIC),
'sale_max.numeric' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_SALE_MAX_NOT_NUMERIC),
'storage.numeric' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_STORAGE_NOT_NUMERIC),
'unit.max' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_UNIT_MAX),
'is_top.in:0,1' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_IS_TOP_NOT_IN),
'is_hot.in:0,1' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_IS_HOT_NOT_IN),
'is_new.in:0,1' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_IS_NEW_NOT_IN),
'is_recommend.in:0,1' => _k_this->ruleMsg(Code::E_-PM-PRODUCT_IS_RECOMMEND_NOT_IN),",



];



