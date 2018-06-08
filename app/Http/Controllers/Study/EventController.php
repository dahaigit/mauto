<?php

namespace App\Http\Controllers\Study;

use App\Events\SendEmailEvent;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * 发送邮件，分发事件
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        $data = [
            'message' => '事件分发成功！',
        ];

        event(new SendEmailEvent($user,$data));
        dd('事件分发成功');
    }
}
