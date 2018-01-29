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
            'withName' => 'galleries', // 函数名称-表关联
            'isPluck' => true,   // 是否使用pluck
            'filedName' => 'image', // 需要使用的字段
            'showKey' => 'gallery_images', // 显示的key字符串
        ],
    ],
    'listSearchFileds' => [
        [
            'withName' => '', // 函数名称-表关联
            'isPTable' => 'true', // 是否是主表
            'filedName' => 'title', // 字段名称
            'type' => '=', // 查询类型
        ],
    ],
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

    ?>
    'pk' => '<?php echo $_pk; ?>',    // 表中主键字段名称
        'fillable' => [<?php echo $_fields_arr; ?>],




];


