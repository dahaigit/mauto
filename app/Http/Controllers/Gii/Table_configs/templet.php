<?php
// 获取数据库每个字段
return [
    'tableName' => 'templet',    // 表名
    'tableNameCn' => '模板表',    // 中文名
    'productModule' => 'School',
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
    'fillable' => ['name','category_id','body','weight'],
        'validateConsts' => "
const E_-PM-TEMPLET_NAME_NOT_EMPTY = 100000;
const E_-PM-TEMPLET_NAME_MAX = 100001;
const E_-PM-TEMPLET_CATEGORY_ID_NOT_EMPTY = 100002;
const E_-PM-TEMPLET_CATEGORY_ID_NOT_NUMERIC = 100003;
const E_-PM-TEMPLET_BODY_NOT_EMPTY = 100004;
const E_-PM-TEMPLET_WEIGHT_NOT_IN = 100005;",
    'validateErrors' => "
Code::E_-PM-TEMPLET_NAME_NOT_EMPTY => '模板名称不能为空！',
Code::E_-PM-TEMPLET_NAME_MAX => '模板名称不能超过255个字符',
Code::E_-PM-TEMPLET_CATEGORY_ID_NOT_EMPTY => '模板分类ID id@cateories不能为空！',
Code::E_-PM-TEMPLET_CATEGORY_ID_NOT_NUMERIC => '模板分类ID id@cateories必须是一个数字',
Code::E_-PM-TEMPLET_BODY_NOT_EMPTY => '不能为空！',
Code::E_-PM-TEMPLET_WEIGHT_NOT_IN => '模板排序',",
    'validateRules' => "
'name' => 'required|max:255',
'category_id' => 'required|numeric',
'body' => 'required',
'weight' => 'in',",
    'validateMessages' => "
'name.required' => Code::E_-PM-TEMPLET_NAME_NOT_EMPTY,
'name.max' => Code::E_-PM-TEMPLET_NAME_MAX,
'category_id.required' => Code::E_-PM-TEMPLET_CATEGORY_ID_NOT_EMPTY,
'category_id.numeric' => Code::E_-PM-TEMPLET_CATEGORY_ID_NOT_NUMERIC,
'body.required' => Code::E_-PM-TEMPLET_BODY_NOT_EMPTY,
'weight.in:0,1' => Code::E_-PM-TEMPLET_WEIGHT_NOT_IN,",



];



