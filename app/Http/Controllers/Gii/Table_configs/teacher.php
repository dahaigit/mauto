<?php
// 获取数据库每个字段
return [
    'tableName' => 'teacher',    // 表名
    'tableNameCn' => '教师表',    // 中文名
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
    'fillable' => ['school_id','user_id','teacher_title_id','status'],
        'validateConsts' => "
const E_-PM-TEACHER_SCHOOL_ID_NOT_EMPTY = 100000;
const E_-PM-TEACHER_SCHOOL_ID_NOT_NUMERIC = 100001;
const E_-PM-TEACHER_USER_ID_NOT_EMPTY = 100002;
const E_-PM-TEACHER_USER_ID_NOT_NUMERIC = 100003;
const E_-PM-TEACHER_TEACHER_TITLE_ID_NOT_EMPTY = 100004;
const E_-PM-TEACHER_TEACHER_TITLE_ID_NOT_NUMERIC = 100005;
const E_-PM-TEACHER_STATUS_NOT_IN = 100006;",
    'validateErrors' => "
Code::E_-PM-TEACHER_SCHOOL_ID_NOT_EMPTY => '学校ID @schools.id不能为空！',
Code::E_-PM-TEACHER_SCHOOL_ID_NOT_NUMERIC => '学校ID @schools.id必须是一个数字',
Code::E_-PM-TEACHER_USER_ID_NOT_EMPTY => '用户ID @users.id不能为空！',
Code::E_-PM-TEACHER_USER_ID_NOT_NUMERIC => '用户ID @users.id必须是一个数字',
Code::E_-PM-TEACHER_TEACHER_TITLE_ID_NOT_EMPTY => '老师职位ID @teacher_titles.id不能为空！',
Code::E_-PM-TEACHER_TEACHER_TITLE_ID_NOT_NUMERIC => '老师职位ID @teacher_titles.id必须是一个数字',
Code::E_-PM-TEACHER_STATUS_NOT_IN => '状态 1:在职 2:离职',",
    'validateRules' => "
'school_id' => 'required|numeric',
'user_id' => 'required|numeric',
'teacher_title_id' => 'required|numeric',
'status' => 'in',",
    'validateMessages' => "
'school_id.required' => Code::E_-PM-TEACHER_SCHOOL_ID_NOT_EMPTY,
'school_id.numeric' => Code::E_-PM-TEACHER_SCHOOL_ID_NOT_NUMERIC,
'user_id.required' => Code::E_-PM-TEACHER_USER_ID_NOT_EMPTY,
'user_id.numeric' => Code::E_-PM-TEACHER_USER_ID_NOT_NUMERIC,
'teacher_title_id.required' => Code::E_-PM-TEACHER_TEACHER_TITLE_ID_NOT_EMPTY,
'teacher_title_id.numeric' => Code::E_-PM-TEACHER_TEACHER_TITLE_ID_NOT_NUMERIC,
'status.in:0,1' => Code::E_-PM-TEACHER_STATUS_NOT_IN,",



];



