// 获取数据库每个字段
return [
    'tableName' => '<?php echo $_tableName; ?>',    // 表名
    'tableNameCn' => '<?php echo $_tableInfo['Comment']; ?>',    // 中文名
    'author' => 'mhl', // 作者
    'moduleName' => 'Admin',  // 代码生成到的模块
    'baseController' => 'ApiController', // 默认base控制器
    'withTables' => [],
    'fields' => [
    <?php foreach ($_tableFields as $_tableField): ?>
        '<?php echo $_tableField['Field']; ?>' => [
                'text' => '<?php echo $_tableField['Comment'] ?>',
                'type' => '<?php echo $_tableField['Type'] ?>',
                'default' => '<?php echo $_tableField['Default'] ?>',
            ],
    <?php endforeach; ?>
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
//        dd($_fields_arr);
    ?>
        'fillable' => [<?php echo $_fields_arr; ?>],




];


