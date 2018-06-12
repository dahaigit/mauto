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
    public function sendEmail(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        if (!$user) {
            dd('没有用户');
        }

        $this->dispatch(new SendEmail($user));
        dd('加入队列成功');

    }
}
