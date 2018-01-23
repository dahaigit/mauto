<?php

namespace App\Http\Controllers\Gii;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

define('GII_CONFIG_PATH', app_path('Http/Controller/Gii/Table_configs/'));
define('GII_TEMPLATE_PATH', app_path('Http/Controllers/Gii/Code_templates/'));
/**
 * api
 *
 * Class GiiController
 * @package App\Http\Controllers
 */
class GiiController extends Controller
{

    public function createConfig(Request $request)
    {
        echo "<pre>";//"show table status WHERE Name LIKE '$___v'"

        $CreateTable = 'Create Table';
        $_tableName = 'products';

        // 获取表信息
        $_tableInfo = DB::select("show table status where name like '$_tableName'");

        if ($_tableInfo) {
            // 获取字段信息
            $_tableFields = DB::select("show FULL COLUMNS from  $_tableName");

//            echo app_path('Http/Controllers/Gii/Code_templates/');
//            exit;
//            echo __DIR__ . '/Code_templates/'.$_tableName.'.php';
//            exit;

            $_tableFields = $this->object_array($_tableFields);
//            dd($_tableFields);
            // 打开缓存
            ob_start();
            include(GII_TEMPLATE_PATH . 'config.php');
            $str = ob_get_clean();
            // 把缓存里面打印出来
            echo file_put_contents( __DIR__ . '/Code_templates/'.$_tableName.'.php', "<?php\r\n".$str);
            print_r($_tableFields);
        }


    }

    // 对象转换成数组
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

