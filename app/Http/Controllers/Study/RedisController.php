<?php

namespace App\Http\Controllers\Study;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    // laravel 操作redis命令大全，https://www.cnblogs.com/mrszhou/p/8087753.html
    /**
     * 插入队列
     * @author luwei
     * @date ${YEAR}-${MONTH}-${DAY} ${TIME}
     */
    public function addRedis()
    {
        // 清空Redis数据库
        Redis::flushall();
        $number = 10;
        $productId = 12;

        for ($i=0; $i < $number; $i++) {
            Redis::rpush('product_' . $productId, 1+$i);
        }
        echo Redis::llen('product_' . $productId);
    }

    /**
     * 购买
     * @author luwei
     * @date ${YEAR}-${MONTH}-${DAY} ${TIME}
     */
    public function shop()
    {
        if ($product = Redis::lpop('product_12')) {
            echo $product;
        } else {
            echo('商品已经卖完');
        }
    }
}
