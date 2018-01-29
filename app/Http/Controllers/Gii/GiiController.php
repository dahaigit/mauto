<?php

namespace App\Http\Controllers\Gii;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

define('APP_PATH', app_path('Http/Controllers/'));
define('MODELS_PATH', app_path('Http/Models/'));
define('GII_PATH', APP_PATH.'Gii/');
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
        header("Content-type: text/html; charset=utf-8");
        $_tableName = 'product';

        $config = @include(GII_CONFIG_PATH . $_tableName . '.php');

        $tpName = $this->_dbName2TpName($config['tableName']);

        // 生成文件夹
        $cDir = APP_PATH . $config['moduleName'];
        $mDir = MODELS_PATH;
        if(!is_dir($cDir))
            mkdir($cDir, 0777);
        if(!is_dir($mDir))
            mkdir($mDir, 0777);

        // 3. 生成控制器文件
        ob_start();
        include(GII_TEMPLATE_PATH . 'Controller.php');
        $str = ob_get_clean();
        file_put_contents($cDir.'/'.$tpName.'Controller.class.php', "<?php\r\n".$str);

        // 4. 生成模型文件
        if (!file_exists($mDir . $tpName)) {
            ob_start();
            include(GII_TEMPLATE_PATH . 'Model.php');
            $str = ob_get_clean();
            file_put_contents($mDir . $tpName . '.php', "<?php\r\n".$str);
        }

        dd($str);
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
        $_tableName = 'product';

        // 获取表信息
        $_tableInfo = DB::select("show table status where name like '$_tableName" . 's' . "'");

        $_tableInfo = $this->object_array($_tableInfo)[0];
        if ($_tableInfo) {
            // 获取字段信息
            $_tableFields = DB::select("show FULL COLUMNS from  $_tableName" . 's');
            $_tableFields = $this->object_array($_tableFields);

            // 开始生成
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

    private function _dbName2TpName($tableName)
    {
        $tableName = explode('_', $tableName);
//        unset($tableName[0]);
        $tableName = array_map('ucfirst', $tableName);
        return implode($tableName);
    }
}

