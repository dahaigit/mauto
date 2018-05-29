<?php

namespace App\Http\Controllers\Study;

use App\Jobs\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class QueueController extends Controller
{
    /**
     * 分发任务，发送邮件
     */
    public function sendEmail()
    {


        $username = $user->username ?? '张三';
        $email = '2210411072@qq.com';



        $res = \Mail::send('emails.sayok', [
            'username' => $username
        ], function ($message) use ($email){
            $message->from('a2210411072@163.com', '大海测试');
            $message->subject('队列测试');
            $message->to($email);
        });
        Log::info($res);
        exit(222);

        $user = User::first();


        $this->dispatch(new SendEmail($user));

    }
}
