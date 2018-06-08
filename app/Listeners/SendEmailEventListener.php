<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailEventListener implements ShouldQueue
{

    /**
     * 任务应该发送到的队列的名称
     *
     * @var string|null
     */
//    public $queue = 'listeners';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendEmailEvent  $event
     * @return void
     */
    public function handle(SendEmailEvent $event)
    {
        $username = $event->user->username;
        $email = $event->user->email;
        $msg = $event->data['message'];

        Mail::send('emails.sayok', [
            'username' => $username
        ], function ($message) use ($email,$msg){
            $message->from('a2210411072@163.com', '大海测试事件');
            $message->subject($msg);
            $message->to($email);
        });
    }
}
