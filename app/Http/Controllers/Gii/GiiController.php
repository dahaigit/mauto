<?php

namespace App\Http\Controllers\Gii;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

define('GII_CONFIG_PATH', app_path('Http/Controllers/Gii/Table_configs/'));
define('GII_TEMPLATE_PATH', app_path('Http/Controllers/Gii/Code_templates/'));
/**
 *
 *
 * Class GiiController
 * @package App\Http\Controllers
 */
class GiiController extends Controller
{
    /**
     * 生成程序
     *
     * @param Request $request
     */
    public function createApp(Request $request)
    {
        $_tableName = 'products';

        $config = @include(GII_CONFIG_PATH . $_tableName . '.php');
        dd($config);
    }

    /**
     * 生成表配置
     *
     * @param Request $request
     */
    public function createConfig(Request $request)
    {
        echo "<pre>";
        $CreateTable = 'Create Table';
        $_tableName = 'products';

        // 获取表信息
        $_tableInfo = DB::select("show table status where name like '$_tableName'");

        if ($_tableInfo) {
            // 获取字段信息
            $_tableFields = DB::select("show FULL COLUMNS from  $_tableName");
            $_tableFields = $this->object_array($_tableFields);

            // 打开缓存
            ob_start();
            include(GII_TEMPLATE_PATH . 'config.php');
            $str = ob_get_clean();
            // 把缓存里面打印出来
            echo file_put_contents( GII_CONFIG_PATH . $_tableName . '.php', "<?php\r\n".$str);
            print_r($_tableFields);
        }
    }

    /**
     * 对象转换成数组
     *
     * @param $array
     * @return array
     */
    public function object_array($array) {
        if(is_object($array)) {
            $array = (array)$array;
        } if(is_array($array)) {
            foreach($array as $key=>$value) {
                $array[$key] = $this->object_array($value);
            }
        }
        return $array;
    }
//    private function _dbName2TpName($tableName)
//    {
//        $tableName = explode('_', $tableName);
//        unset($tableName[0]);
//        $tableName = array_map('ucfirst', $tableName);
//        return implode($tableName);
//    }
    //表名变成小驼峰法，
    public function _dbName2TpName($tableName){
        $tableName = explode('_', $tableName);
        dd($tableName);
    }
}

