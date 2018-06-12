<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BroadcastEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;

    /**
     * 指定事件被放置在哪个队列上
     *
     * @var string
     */
//    public $broadcastQueue = 'your-queue-name';

    /**
     * 创建一个新的事件实例
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * 指定事件在哪些频道上进行广播
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->user->id);
    }

    /**
     * 事件的广播名称。
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'server.created';
    }

    /**
     * 确定是否应该播放此事件。
     *
     * @return bool
     */
    public function broadcastWhen()
    {
//        return $this->value > 100;
    }
}
