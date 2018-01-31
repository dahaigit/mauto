namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class <?php echo $tpName; ?> extends Model
{
    use SoftDeletes;

    protected $fillable = [
    <?php foreach ($config['fillable'] as $v) {?>
        '<?php echo $v;?>',
    <?php } ?>
];

<?php foreach ($config['withTables'] as $withTable) {?>
    /**
    * <?php echo $withTable['tableNameCn']; ?>,
    * author  <?php echo $config['author']; ?>,
    * relation  <?php echo $withTable['relation']; ?>,
    * date    <?php echo date('Y-m-d H:i:s'); ?>,
    * @return @return \Illuminate\Database\Eloquent\Relations\
    */
    function <?php echo $withTable['withName']?>()
    {
        <?php echo $withTable['return']?>;
    }

<?php } ?>

}
