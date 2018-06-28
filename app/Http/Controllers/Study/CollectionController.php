<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    public function index()
    {
        //23）forget 忘记，去掉指定键的元素
        /*$a = ['name' => 'Regena', 'age' => 12, 'color' => 'red'];
        dd(collect($a)->forget(['name', 'age'])->all());*/
        /*
         *array:1 [
          "color" => "red"
        ]
         * */

        //22）flip 反转，键值反转
        /*$a = ['name' => 'Regena', 'age' => 12];
        dd(collect($a)->flip()->all());*/
        /*
         * array:2 [
          "Regena" => "name"
          12 => "age"
        ]
         * */

        //21）flatten 压扁，二维变一维数组
        /*$a = [
            ['name' => 'Regena', 'age' => 12],
            ['name1' => 'Linda1', 'age1' => 14],
        ];
        dd(collect($a)->flatten()->all());*/
        /*
         *array:4 [
          0 => "Regena"
          1 => 12
          2 => "Linda1"
          3 => 14
        ]
         * */

        //20）flatMap 循环每个元素，然后二维变一维数组
        /*$a = [
            ['name' => 'Regena', 'age' => 12],
            ['name1' => 'Linda1', 'age1' => 14],
        ];
        dd(collect($a)->flatMap(function ($value){
            return array_map('strtoupper', $value);
        })->all());*/
        /*
         * array:4 [
          "name" => "REGENA"
          "age" => "12"
          "name1" => "LINDA1"
          "age1" => "14"
        ]
         * */

        //19 firstWhere 获取查询结果第一个
        /*$a = [
            ['name' => 'Regena', 'age' => 12],
            ['name' => 'Linda', 'age' => 14],
            ['name' => 'Diego', 'age' => 23],
            ['name' => 'Linda', 'age' => 84],
        ];
        dd(collect($a)->firstWhere('name', 'Diego'));*/
        /*
         * array:2 [
          "name" => "Diego"
          "age" => 23
        ]
         * */

        //18）first 第一，获取过滤后的第一个数据
        /*$a = [1,2,8,20];
        dd(collect($a)->first(function ($item, $key){
            return $item > 5;
        }));*/
        /*
         *8
         * */

        //17）filter 过滤器，
        /*$a = [1,2,8,20];
        $b = [12,null,false, '', []];
        dd(collect($a)->filter(function ($item, $key){
            return $item < 10;
        })->all());
        dd(collect($b)->filter()->all());*/
        /*
         *array:3 [
          0 => 1
          1 => 2
          2 => 8
        ]
        array:1 [
          0 => 12
        ]
         * */

        //16）except 除了，除了指定键的元素
        /*$a = [1=>'a',10=> 'b', 9=> 'c'];
        dd(collect($a)->except('1', '9')->all());*/
        /*
         * array:1 [
          10 => "b"
        ]
         * */

        //15）every 验证一维数组每个值是否符合规则，bool
        /*$a = [['John Doe', 35, 'yellow'], ['Jane Doe', 33, 'red'], null];
        dd(collect($a)->every(function ($value,$key){
            return $value ? true : false;
        }));*/
        /*
         * false
         * */

        //14）eachSpread 遍历数组,按块遍历
        /*$a = [['John Doe', 35, 'yellow'], ['Jane Doe', 33, 'red']];
        collect($a)->eachSpread(function ($name, $age, $color){
            dd($name, $age, $color);
        });*/
        /*
         * "John Doe"
            35
            "yellow"
         * */

        //13）each 遍历数组
        /*$a = [1=>'a',10=> 'b', 9=> 'c'];
        collect($a)->each(function($item, $key){
            dd($key,$item);
        });*/
        /*
         * 1
           "a"
         * */



        //12)diffAssoc 找不同，比较两个数值的key和value
        /*$a = [1=>'a',10=> 'b', 9=> 'c'];
        $b = ['c' ,'d'];
        dd(collect($a)->diffAssoc($b)->toArray());*/
        /*
         *array:3 [
          1 => "a"
          10 => "b"
          9 => "c"
        ]
         * */

        //11）diff 不同的，比较两个数值不同的值
        /*$a = [1=>'a',10=> 'b', 9=> 'c'];
        $b = ['c' ,'d'];
        dd(collect($a)->diff($b)->toArray());*/
        /*
         * array:2 [
              1 => "a"
              10 => "b"
            ]
         * */


        //10）dd 打印 dump打印不停止
        /*$a = ['a' , 'b'];
        collect($a)->dd();*/
        /*
         * Collection {#476
          #items: array:2 [
            0 => "a"
            1 => "b"
          ]
        }
         * */


        //9）crossJoin 笛卡尔积链接
        /*$a = ['a' , 'b'];
        $b = ['c' ,'d'];
        dd(collect($a)->crossJoin($b)->toArray());*/
        /*
         * array:4 [
          0 => array:2 [
            0 => "a"
            1 => "c"
          ]
          1 => array:2 [
            0 => "a"
            1 => "d"
          ]
          2 => array:2 [
            0 => "b"
            1 => "c"
          ]
          3 => array:2 [
            0 => "b"
            1 => "d"
          ]
        ]
         * */

        //8）count 计数
        /*$b = [['a' => '111'],['ddd']];
        dd(collect($b)->count());*/
        /*
         * 2
         * */

        //7）contains 包含，判断某个值是否存在，containsStrict 严格匹配
        /*$a = ['a' => '111' , 'b'];
        $b = [['a' => '111'],['ddd']];
        dd(collect($a)->contains('ab'));
        dd(collect($b)->contains('a', '111'));*/
        /*
         * false
         * true
         * */

        //6）concat 合并数组
        /*$a = ['a' , 'b'];
        $b = [1, 3];
        dd(collect($a)->concat($b)->toArray());*/
        /*
         * array:4 [
              0 => "a"
              1 => "b"
              2 => 1
              3 => 3
            ]
         * */

        //5）combine 结合，两个数组一个作为key，一个作为value
        /*$a = ['a' , 'b'];
        $b = [1, 3];
        dd(collect($a)->combine($b)->toArray());*/
        /*
         * array:2 [
              "a" => 1
              "b" => 3
            ]
         * */

        //4) collapse 折叠，把二维数组转换为一维数组
        /*$a = ['a' => '6', 'ad' => ['d' => 777,'f' => 888], '6' => ['sh' => 999, 'bj' => ['123'=> 222]]];
        dd(collect($a)->collapse()->toArray());*/
        /*
         array:4 [
          "d" => 777
          "f" => 888
          "sh" => 999
          "bj" => array:1 [
            123 => 222
          ]
        ]
         * */

        //3)chunk 块，把数组分成块，比如在一行只能显示3个的时候用
        /*$a = ['a' => '6', '6', '6', '6'];
        dd(collect($a)->chunk(2)->toArray());*/
        /*
         * array:2 [
              0 => array:2 [
                "a" => "6"
                0 => "6"
              ]
              1 => array:2 [
                1 => "6"
                2 => "6"
              ]
            ]
         * */

        //2) avg 平均数
        /* $a = ['a' => '6', '6', '6', '6'];
        dd(collect($a)->avg());*/
        /*
         * 6
         * */

       //1） all 一维数组的时候相当于toArray
        /*$a = ['a' => '343', 'b', '3', 'd'];
        dd(collect($a)->all());*/
        /* array:4 [
              "a" => "343"
              0 => "b"
              1 => "3"
              2 => "d"
            ]
         * */
    }
}
