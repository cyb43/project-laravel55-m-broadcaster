<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//// ^2_3^事件广播系统
//
////
//
// 广播事件(公共频道)
Route::get('/broadcast-event', function () {
    broadcast( new \App\Events\EventBroadcast() );

    return "已经广播EventBroadcast事件；";
});
//
// 广播事件(私有频道)
Route::get('/event-broadcast-private', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    event( new \App\Events\EventBroadcastPrivate($user));

    return "已经广播EventBroadcastPrivate事件(user[{$user->id}])；";
});
//
// 监听事件
Route::get('/', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    if( $user ) {
        $user = collect($user)->toArray();
    }
    return view('welcome', ['user'=>$user]);
});

//// web授权模块路由
//php artisan make:auth
// php artisan migrate
//
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
//