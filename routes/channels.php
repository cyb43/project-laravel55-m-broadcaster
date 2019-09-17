<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

//// 频道授权
// channel 方法接收两个参数：频道名称和一个回调函数，该回调通过返回 true 或 false 来表示用户是否被授权监听该频道。
// 框架发起请求自动验证，无需手动请求。所有的授权回调接收当前被认证的用户作为第一个参数，任何额外的通配符参数作为后续参数。
//Broadcast::channel('App.User.{id}', function ($user, $id) {
//    return (int) $user->id === (int) $id;
//});
// 需要web登录，才能进行频道授权
Broadcast::channel('channels-private-user-{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});