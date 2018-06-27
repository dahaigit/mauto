<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use App\Mailer\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailEventListener
{

    /**
     * 任务应该发送到的队列的名称
     *
     * @var string|null
     */
//    public $queue = 'listeners';

    public $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserMailer $userMailer)
    {
        $this->mailer = $userMailer;
    }

    /**
     * Handle the event.
     *
     * @param  SendEmailEvent  $event
     * @return void
     */
    public function handle(SendEmailEvent $event)
    {
        $this->mailer->cloudRegister($event->user);
    }
}
