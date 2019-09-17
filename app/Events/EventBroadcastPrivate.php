<?php

namespace App\Events;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

/**
 * 事件广播系统_私有频道
 * Class EventBroadcastPrivate
 * @package App\Events
 * @author ^2_3^王尔贝
 */
class EventBroadcastPrivate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * 用户模型，用以确定归属哪个私有频道
     * @var
     * @author ^2_3^王尔贝
     */
    private $user;

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
                'eventname' => 'EventBroadcastPrivate',
                'channelchannel' => 'channels-private-user-{id}',
                'devname' => 'cyb43',
            ]
        ];
    }

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channels-private-user-'.$this->user->id);

        //// 提示：需要定义授权频道路由供框架自动请求授权；
        //// 频道授权
        // channel 方法接收两个参数：频道名称和一个回调函数，该回调通过返回 true 或 false 来表示用户是否被授权监听该频道。
        // 框架发起请求自动验证，无需手动请求。所有的授权回调接收当前被认证的用户作为第一个参数，任何额外的通配符参数作为后续参数。
        //Broadcast::channel('App.User.{id}', function ($user, $id) {
        //    return (int) $user->id === (int) $id;
        //});
//        Broadcast::channel('channels-private-user-{id}', function ($user, $id) {
//            return (int) $user->id === (int) $id;
//        });
    }
}
