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
//        dd($user);
        event(new SendEmailEvent($user));
        dd('事件分发成功');
    }
}
