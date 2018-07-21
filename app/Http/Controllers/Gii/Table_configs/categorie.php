<?php
// 获取数据库每个字段
return [
    'tableName' => 'categorie',    // 表名
    'tableNameCn' => '模板分类表',    // 中文名
    'productModule' => 'Message',
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
    'fillable' => ['name','weight'],
        'validateConsts' => "
const E_-PM-CATEGORIE_NAME_NOT_EMPTY = 100000;
const E_-PM-CATEGORIE_NAME_MAX = 100001;
const E_-PM-CATEGORIE_WEIGHT_NOT_IN = 100002;",
    'validateErrors' => "
Code::E_-PM-CATEGORIE_NAME_NOT_EMPTY => '分类名称不能为空！',
Code::E_-PM-CATEGORIE_NAME_MAX => '分类名称不能超过255个字符',
Code::E_-PM-CATEGORIE_WEIGHT_NOT_IN => '分类排序',",
    'validateRules' => "
'name' => 'required|max:255',
'weight' => 'in',",
    'validateMessages' => "
'name.required' => Code::E_-PM-CATEGORIE_NAME_NOT_EMPTY,
'name.max' => Code::E_-PM-CATEGORIE_NAME_MAX,
'weight.in:0,1' => Code::E_-PM-CATEGORIE_WEIGHT_NOT_IN,",



];



