// 获取数据库每个字段
return [
    'fields' => [
    <?php foreach ($_tableFields as $_tableField): ?>
        '<?php echo $_tableField['Field']; ?>' => [
                'text' => '<?php echo $_tableField['Comment'] ?>',
                'type' => '<?php echo $_tableField['Type'] ?>',
                'default' => '<?php echo $_tableField['Default'] ?>',
            ],
    <?php endforeach; ?>
],

];


