// 获取数据库每个字段
return [
    'tableName' => '<?php echo $_tableName; ?>',    // 表名
    'tableNameCn' => '<?php echo $_tableInfo['Comment']; ?>',    // 中文名
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
    'validateConst' => "<?php echo _validate($_tableFields, $_pk, $_tableName)['validateConst']; ?>",
    'validateErrors' => "Code::E_WECHAT_MESSAGE_KEYWORDS_EMPTY => '关键词不能为空！',
                        Code::E_WECHAT_MESSAGE_KEYWORDS_MAX => '关键词的值最长不能超过:max个字符！',
                        Code::E_WECHAT_MESSAGE_MESSAGE_EMPTY => '消息不能为空！',
                        Code::E_WECHAT_MESSAGE_MESSAGE_MAX => '消息的值最长不能超过:max个字符！',
                        Code::E_WECHAT_MESSAGE_IS_OPEN_EMPTY => '是否开发不能为空！',
                        Code::E_WECHAT_MESSAGE_IS_OPEN_IN => '是否开放必须选择 1,2 其中一个！',",
    'validateRules' => "'keywords' => 'required',
                        'message' => 'required',
                        'is_open' => 'required|in:1,2',",
    'validateMessages' => "'keywords.required' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_KEYWORDS_EMPTY),
                        'message.required' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_MESSAGE_EMPTY),
                        'is_open.required' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_IS_OPEN_EMPTY),
                        'is_open.in' => $this->ruleMsg(Code::E_WECHAT_MESSAGE_IS_OPEN_IN),",



];

<?php
 function _validate($_tableFields, $_pk, $_tableName) {
     $validateConsts = ''; // 错误常量
     $validateErrors = ''; // 错误文字
     $validateRules = ''; // 控制器规则
     $validateMessages = ''; // 控制器消息

     $constNum = 1;
     foreach ($_tableFields as $k => $v) {

         $validateConst = strtoupper('const E_V_MODULE_' . $_tableName . '_' . $v['Field'] . '_')  ; // E_,模块名(v_module),表名,字段名,具体规则

         // 关键字处理
         if ($v['Field'] == $_pk || $v['Field'] == 'deleted_at' || $v['Field'] == 'created_at' || $v['Field'] == 'updated_at') continue;
         // 字段处理
         if ($v['Field'] == 'email') {
            $validateConsts .= "$validateConst NOT_EMAILL = $constNum;";
            ++$constNum;
         }
         // 非空处理
         if ($v['Null'] == 'NO' && $v['Default'] === null){
             $validateConsts .= "$validateConst NOT_EMPTY  = $constNum;";
             ++$constNum;
         }
         // 唯一处理
         if($v['Key'] == 'UNI') {
             $validateConsts .= "$validateConst EXSITS = $constNum ;";
             ++$constNum;
         }
         // 字段类型处理
         $filedType = $v['Type'];
         switch ($filedType) {
             case 'int':
                 $validateConsts .= "($validateConst) NOT_NUMERIC = ($constNum) ;";
                 ++$constNum;
                 break;
             case 'decimal':
                 $validateConsts .= "$validateConst NOT_DECIMAL = ' . $constNum . ';'";
                 ++$constNum;
                 break;
             case 'enum':
                 $validateConsts .= "$validateConst NOT_EXSITS = ' . $constNum . ';'";
                 ++$constNum;
                 break;
             case 'varchar':
                 $validateConsts .= "$validateConst MAX = $constNum . ';'";
                 ++$constNum;
                 break;
             case 'char':
                 $validateConsts .= "$validateConst MAX =  $constNum . ';'";
                 ++$constNum;
                 break;
         }
     }

     return [
        'validateConst' => $validateConsts,
        'validateErrors' => $validateErrors,
        'validateRules' => $validateRules,
        'validateMessages' => $validateMessages,
     ];
 }
?>


