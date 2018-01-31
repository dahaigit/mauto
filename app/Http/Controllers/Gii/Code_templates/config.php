// 获取数据库每个字段
return [
    'tableName' => '<?php echo $_tableName; ?>',    // 表名
    'tableNameCn' => '<?php echo $_tableInfo['Comment']; ?>',    // 中文名
    'author' => 'mhl', // 作者
    'moduleName' => 'Admin',  // 代码生成到的模块
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
    'validate' => "
    <?php foreach ($_tableFields as $k => $v):
        $_chkTime = 2;
        if($v['Field'] == $_pk || $v['Field'] == 'deleted_at' || $v['Field'] == 'created_at' || $v['Field'] == 'updated_at' )
            continue ;
        if($v['Null'] == 'NO' && $v['Default'] === null):$_chkTime=1; ?>
            array('<?php echo $v['Field']; ?>', 'required', '<?php echo $v['Comment']; ?>不能为空！', <?php echo $_chkTime; ?>, 'regex', 3),
        <?php endif;
        if($v['Field'] == 'email'): ?>
            array('<?php echo $v['Field']; ?>', 'email', '<?php echo $v['Comment']; ?>格式不正确！', <?php echo $_chkTime; ?>, 'regex', 3),
        <?php endif;
        if(strpos($v['Type'], 'int') !== FALSE): ?>
            array('<?php echo $v['Field']; ?>', 'number', '<?php echo $v['Comment']; ?>必须是一个整数！', <?php echo $_chkTime; ?>, 'regex', 3),
        <?php endif;
        if(strpos($v['Type'], 'decimal') !== FALSE): ?>
            array('<?php echo $v['Field']; ?>', 'currency', '<?php echo $v['Comment']; ?>必须是货币格式！', <?php echo $_chkTime; ?>, 'regex', 3),
        <?php endif;
        if(strpos($v['Type'], 'enum') !== FALSE): ?>
            array('<?php echo $v['Field']; ?>', <?php $_s1 = str_replace(array('enum(', ')', "','"), array('','',','), $v['Type']);echo $_s1; ?>, \"<?php echo $v['Comment']; ?>的值只能是在 <?php echo $_s1; ?> 中的一个值！\", <?php echo $_chkTime; ?>, 'in', 3),
        <?php endif;
        if(strpos($v['Type'], 'varchar') === 0): ?>
            array('<?php echo $v['Field']; ?>', '<?php $_s1 = str_replace(array('varchar(', ')'), array('',''), $v['Type']);echo 'max:' . $_s1; ?>', '<?php echo $v['Comment']; ?>的值最长不能超过 <?php echo $_s1; ?> 个字符！', <?php echo $_chkTime; ?>, 'length', 3),
        <?php endif;
        if(strpos($v['Type'], 'char') === 0): ?>
            array('<?php echo $v['Field']; ?>', '<?php $_s1 = str_replace(array('char(', ')'), array('',''), $v['Type']);echo 'max:' . $_s1; ?>', '<?php echo $v['Comment']; ?>的值最长不能超过 <?php echo $_s1; ?> 个字符！', <?php echo $_chkTime; ?>, 'length', 3),
        <?php endif;
    endforeach; ?>
    <?php foreach ($_tableFields as $k => $v):
        $_chkTime = 2;
        if($v['Field'] == $_pk)
            continue ;
        if($v['Null'] == 'NO' && $v['Default'] === null)
            $_chkTime=1;
        if($v['Key'] == 'UNI'): ?>
            array('<?php echo $v['Field']; ?>', '', '<?php echo $v['Comment']; ?>的值已经存在，不能重复添加！', <?php echo $_chkTime; ?>, 'unique', 3),
        <?php endif;
    endforeach; ?>
    ",



];


