<?php
// 获取数据库每个字段
return [
    'tableName' => 'classe',    // 表名
    'tableNameCn' => '班级表',    // 中文名
    'productModule' => 'SCHOOL',
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
    'fillable' => ['grade_name','alias_name','number','year','status'],
        'validateConsts' => "
const E_-PM-CLASSE_GRADE_NAME_NOT_EMPTY = 1;
const E_-PM-CLASSE_GRADE_NAME_MAX = 2;
const E_-PM-CLASSE_ALIAS_NAME_MAX = 3;
const E_-PM-CLASSE_NUMBER_NOT_EMPTY = 4;
const E_-PM-CLASSE_NUMBER_NOT_NUMERIC = 5;
const E_-PM-CLASSE_YEAR_NOT_EMPTY = 6;
const E_-PM-CLASSE_YEAR_MAX = 7;
const E_-PM-CLASSE_STATUS_NOT_IN = 8;",
    'validateErrors' => "
Code::E_-PM-CLASSE_GRADE_NAME_NOT_EMPTY => '年级名称不能为空！',
Code::E_-PM-CLASSE_GRADE_NAME_MAX => '年级名称的值最长不能超过255',
Code::E_-PM-CLASSE_ALIAS_NAME_MAX => '班级别名的值最长不能超过255',
Code::E_-PM-CLASSE_NUMBER_NOT_EMPTY => '人数不能为空！',
Code::E_-PM-CLASSE_NUMBER_NOT_NUMERIC => '人数必须是一个数字',
Code::E_-PM-CLASSE_YEAR_NOT_EMPTY => '开班年份不能为空！',
Code::E_-PM-CLASSE_YEAR_MAX => '开班年份的值最长不能超过4',
Code::E_-PM-CLASSE_STATUS_NOT_IN => '状态: 1:学期中 2:已毕业',",
    'validateRules' => "
'grade_name' => 'required|max:255',
'alias_name' => 'max:255',
'number' => 'required|numeric',
'year' => 'required|max:4',
'status' => 'in',",
    'validateMessages' => "
'grade_name.required' => _k_this->ruleMsg(Code::E_-PM-CLASSE_GRADE_NAME_NOT_EMPTY),
'grade_name.max' => _k_this->ruleMsg(Code::E_-PM-CLASSE_GRADE_NAME_MAX),
'alias_name.max' => _k_this->ruleMsg(Code::E_-PM-CLASSE_ALIAS_NAME_MAX),
'number.required' => _k_this->ruleMsg(Code::E_-PM-CLASSE_NUMBER_NOT_EMPTY),
'number.numeric' => _k_this->ruleMsg(Code::E_-PM-CLASSE_NUMBER_NOT_NUMERIC),
'year.required' => _k_this->ruleMsg(Code::E_-PM-CLASSE_YEAR_NOT_EMPTY),
'year.max' => _k_this->ruleMsg(Code::E_-PM-CLASSE_YEAR_MAX),
'status.in:0,1' => _k_this->ruleMsg(Code::E_-PM-CLASSE_STATUS_NOT_IN),",



];



