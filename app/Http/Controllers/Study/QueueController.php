<?php

namespace App\Http\Controllers\Study;

use App\Events\ProjectCreateEvent;
use App\Events\TaskEvent;
use App\Jobs\SendEmail;
use App\Models\Project;
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

    public function index(Request $request)
    {
        $project = Project::find(1);
        event(new ProjectCreateEvent($project));

        dd(env('BROADCAST_DRIVER'));
        exit;
    }
}
