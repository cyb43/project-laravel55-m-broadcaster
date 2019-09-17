<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 广播系统事件
 * Class EventBroadcast
 * @package App\Events
 * @author ^2_3^王尔贝
 */
class EventBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * 指定事件被放置在哪个队列上
     * 使用 php artisan queue:work --queue=event-broadcast-queue 监听处理事件广播队列；
     * 使用 php artisan queue:work 监听处理的是default默认队列；
     *
     * @var string
     */
    public $broadcastQueue = 'event-broadcast-queue';

    /**
     * 广播事件事件
     * @return array
     * @author ^2_3^王尔贝
     */
    public function broadcastWith()
    {
        return [
            'eventdata' => [
                'eventname' => 'EventBroadcast',
                'channelchannel' => 'channels-broadcasts',
                'devname' => 'cyb43',
            ]
        ];
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {

        return new Channel('channels-broadcasts');

        //return new PrivateChannel('channel-name');
    }
}
