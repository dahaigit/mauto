// 获取数据库每个字段
return [
    'tableName' => '<?php echo $_tableName; ?>',    // 表名
    'tableNameCn' => '<?php echo $_tableInfo['Comment']; ?>',    // 中文名
    'productModule' => '<?php
echo $_productModule;

?>',
    'author' => '孟海龙', // 作者
    'moduleName' => 'Api',  // 代码生成到的模块
    'baseController' => 'BaseController', // 默认base控制器
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
    <?php
        $_fields_arr = array();
        $_pk = 'id';
        foreach ($_tableFields as $k => $v)
        {
            if($v['Key'] == 'PRI')
            {
                $_pk = $v['Field'];
                continue ;
            }
            if($v['Field'] == 'created_at' || $v['Field'] == 'updated_at' || $v['Field'] == 'deleted_at')
            {
                continue ;
            }

            $_fields_arr[] = "'{$v['Field']}'";
        }
        $_fields_arr = implode(',', $_fields_arr);

    ?>
    'pk' => '<?php echo $_pk; ?>',    // 表中主键字段名称
    'fillable' => [<?php echo $_fields_arr; ?>],
    <?php
    $validateRules = ''; // 控制器规则
    $_validate = _validate($_tableFields, $_pk, $_tableName);
    ?>
    'validateConsts' => "<?php echo $_validate['validateConsts']; ?>",
    'validateErrors' => "<?php echo $_validate['validateErrors']; ?>",
    'validateRules' => "<?php echo rulesMakeStr(); ?>",
    'validateMessages' => "<?php echo $_validate['validateMessages']; ?>",



];

<?php

 function _validate($_tableFields, $_pk, $_tableName) {
     $validateConsts = ''; // 错误常量
     $validateErrors = ''; // 错误文字
     $validateMessages = ''; // 控制器消息

     $constNum = 1;
     foreach ($_tableFields as $k => $v) {

         $validateConst = strtoupper('const E_V_MODULE_' . $_tableName . '_' . $v['Field'] . '_')  ; // E_,模块名(v_module),表名,字段名,具体规则

         // 关键字处理
         if ($v['Field'] == $_pk || $v['Field'] == 'deleted_at' || $v['Field'] == 'created_at' || $v['Field'] == 'updated_at') continue;
         // 字段处理
         if ($v['Field'] == 'email') {
             $constStr = constMake('NOT_EMAILL', $_tableName, $v['Field']);
            $validateConsts .= constFunc('NOT_EMAILL', $_tableName, $v['Field']);
            $validateErrors .= constMessage($constStr, $v['Comment'] . '格式不正确！');
             $validateMessages .= ruleMsgMake($constStr, 'email', $v['Field']);
             rulesMake('email', $v['Field']);
         }
         // 非空处理
         if ($v['Null'] == 'NO' && $v['Default'] === null){
             $constStr = constMake('NOT_EMPTY', $_tableName, $v['Field']);
             $validateConsts .= constFunc('NOT_EMPTY', $_tableName, $v['Field']);
             $validateErrors .= constMessage($constStr, $v['Comment'] . '不能为空！');
             $validateMessages .= ruleMsgMake($constStr, 'required', $v['Field']);
             rulesMake('required', $v['Field']);
         }
         // 唯一处理
         if($v['Key'] == 'UNI') {
             $constStr = constMake('EXSITED', $_tableName, $v['Field']);
             $validateConsts .= constFunc('EXSITED', $_tableName, $v['Field']);
             $validateErrors .= constMessage($constStr, $v['Comment'] . '的值已经存在，不能重复添加！');
             $validateMessages .= ruleMsgMake($constStr, 'unique:'. $_tableName . 's', $v['Field']);
             rulesMake('unique:'. $_tableName . 's', $v['Field']);
         }
         // 字段类型处理
         $filedType = $v['Type'];
         switch (true) {
             case strpos($filedType, 'tinyint') !== false:
                 $constStr = constMake('NOT_IN', $_tableName, $v['Field']);
                 $validateConsts .= constFunc('NOT_IN', $_tableName, $v['Field']);
                 $validateErrors .= constMessage($constStr, $v['Comment']);
                 $validateMessages .= ruleMsgMake($constStr, 'in:0,1', $v['Field']);
                 rulesMake('in', $v['Field']);
                 break;
             case strpos($filedType, 'int') !== false:
                 $constStr = constMake('NOT_NUMERIC', $_tableName, $v['Field']);
                 $validateConsts .= constFunc('NOT_NUMERIC', $_tableName, $v['Field']);
                 $validateErrors .= constMessage($constStr, $v['Comment'] . '必须是一个数字');
                 $validateMessages .= ruleMsgMake($constStr, 'numeric', $v['Field']);
                 rulesMake('numeric', $v['Field']);
                 break;
             case strpos($filedType, 'decimal') !== false:
                 $constStr = constMake('NOT_DECIMAL', $_tableName, $v['Field']);
                 $validateConsts .= constFunc('NOT_DECIMAL', $_tableName, $v['Field']);
                 $validateErrors .= constMessage($constStr, $v['Comment'] . '必须是一个数字！');
                 $validateMessages .= ruleMsgMake($constStr, 'numeric', $v['Field']);
                 rulesMake('numeric', $v['Field']);
                 break;
             case strpos($filedType, 'enum') !== false:
                 $constStr = constMake('NOT_EXSITS', $_tableName, $v['Field']);
                 $validateConsts .= constFunc('NOT_EXSITS', $_tableName, $v['Field']);
                 $validateErrors .= constMessage($constStr, $v['Comment'] . '的值只能是在 ' . str_replace(array('enum(', ')', "','"), array('','',','), $v['Type']));
                 $validateMessages .= ruleMsgMake($constStr, 'in:' . str_replace(array('enum(', ')', "','"), array('','',','), $v['Type']), $v['Field']);
                 rulesMake('in:' . str_replace(array('enum(', ')', "','"), array('','',','), $v['Type']), $v['Field']);
                 break;
             case strpos($filedType, 'varchar') !== false:
                 $constStr = constMake('MAX', $_tableName, $v['Field']);
                 $validateConsts .= constFunc('MAX', $_tableName, $v['Field']);
                 $validateErrors .= constMessage($constStr, $v['Comment'] . '不能超过' . str_replace(array('varchar(', ')'), array('',''), $v['Type']) . '个字符');
                 $validateMessages .= ruleMsgMake($constStr, 'max', $v['Field']);
                 rulesMake('max:' . str_replace(array('varchar(', ')'), array('',''), $v['Type']), $v['Field']);
                 break;
             case strpos($filedType, 'char') !== false:
                 $constStr = constMake('MAX', $_tableName, $v['Field']);
                 $validateConsts .= constFunc('MAX', $_tableName, $v['Field']);
                 $validateErrors .= constMessage($constStr, $v['Comment'] . '不能超过' . str_replace(array('char(', ')'), array('',''), $v['Type']) . '个字符');
                 $validateMessages .= ruleMsgMake($constStr, 'max', $v['Field']);
                 rulesMake('max:' . str_replace(array('char(', ')'), array('',''), $v['Type']), $v['Field']);
                 break;
         }
         $constStr = '';
     }

     return [
        'validateConsts' => $validateConsts,
        'validateErrors' => $validateErrors,
        'validateMessages' => $validateMessages,
     ];
 }

 // 生成常量 const
 function constMake($str, $_tableName, $field, $config = '')
 {
     // E_,模块名(v_module),表名,字段名,具体规则
     return strtoupper('E_-PM-' . $_tableName . '_' . $field . '_') . $str; // E_,模块名(v_module),表名,字段名,具体规则
 }

 // 控制器规则 validateRules
 function rulesMake($rule, $field)
 {
     if (isset($GLOBALS['validateRules'][$field])) {
         $GLOBALS['validateRules'][$field] .= '|' .$rule;
     } else {
         $GLOBALS['validateRules'][$field] = $rule;
     }
 }

 // 控制器规则字符串
function rulesMakeStr()
{
    $validateRuleStr = '';
    foreach ($GLOBALS['validateRules'] as $k => $validateRule) {
        //[category_id] => required|numeric
        $validateRuleStr .= "\n'{$k}' => '{$validateRule}',";
    }
    return $validateRuleStr;
}

 // 控制器消息 validateMessages
 function ruleMsgMake($constStr, $rule, $field)
 {
     return "\n" . "'{$field}.{$rule}'" . ' => Code::' . $constStr . ',';
 }

 // 错误常量 validateConsts
 function constFunc($str, $_tableName, $field) {
     static $constNum = 100000;
     $constStr = constMake($str, $_tableName, $field);
     $validateConst = "\n"."const {$constStr} = $constNum;";
     $constNum++;
     return $validateConst;
 }

 // 错误文字 validateErrors
 function constMessage($constStr, $msg) {
     return "\n"."Code::{$constStr} => '{$msg}',";
 }
?>


