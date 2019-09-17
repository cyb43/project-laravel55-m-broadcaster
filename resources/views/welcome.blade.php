<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--
        Laravel5.5_事件广播系统-Redis广播器(结合Redis队列)+LaravelEchoServer(作为Socket.IO服务器/WebSocket服务器)+LaravelEcho客户端；
        -->
        <title>
            Laravel5.5.28_事件广播系统-Redis广播器(结合Redis队列)+LaravelEchoServer(作为Socket.IO服务器/WebSocket服务器)+LaravelEcho客户端
        </title>
        <!-- 1、引入csrf -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- 2、引入Socket.IO JavaScript 客户端库(通过访问LaravelEchoServer暴露的Socket.IO客户端脚本) -->
        <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
        <!-- 3、实例化Echo -->
        <script src="/js/app.js"></script>
        <script>
            <!--上面app.js已经进行了Echo的实例化，然后应该使用实例化的Echo进行广播事件的监听-->
            console.log(Echo);

            //// 订阅channels-broadcasts频道，监听EventBroadcast事件。
            Echo.channel('channels-broadcasts')
                .listen('EventBroadcast', (e) => {
                // 如果有广播过来的事件你可以进行逻辑操作；
                console.log(e);

                // 获取自定义事件数据
                eventdata = JSON.stringify(e.eventdata);
                $('#app').append("<div>"+eventdata+"</div>");
            });

            @if ($user)
                //// 订阅私有频道
                Echo.private("channels-private-user-{{$user['id']}}")
                    .listen('EventBroadcastPrivate', (e) => {

                    // 获取自定义事件数据
                    eventdata = JSON.stringify(e.eventdata);
                    $('#app').append("<div>"+eventdata+"</div>");
                });
                console.log("监听私有频道(channels-private-user-{{$user['id']}})");
            @else
                console.log('没有登录，不能监听私有频道');
            @endif

        </script>

        <!-- jQuery库 -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel5.5.28
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>

                <div style="text-align: left; padding: 0 25px;">
                    <div>^2_3^</div>
                    <div id="d-eventbroadcast">
                        <a href="javascript:void(0);">广播"EventBroadcast"事件(公共频道)</a>
                    </div>

                    @if ($user)
                    <div id="d-Event-broadcast-private">
                        <a href="javascript:void(0);">广播"EventBroadcastPrivate"事件(私有频道)</a>
                    </div>
                    @endif
                </div>

            </div>

        </div>

        <div id="app">
            <div>广播系统事件监听_输出</div>
        </div>

        <script type="application/javascript">
            $(document).ready(function(){
                // 广播"EventBroadcast"事件
                $("#d-eventbroadcast").click(function() {
                    $.get( "http://project-laravel55-m-broadcaster.test/broadcast-event", function( data ) {
                        console.log( data );
                    });
                });

                // 广播"EventBroadcastPrivate"事件
                $("#d-Event-broadcast-private").click(function() {
                    $.get( "http://project-laravel55-m-broadcaster.test/event-broadcast-private", function( data ) {
                        console.log( data );
                    });
                });
            });
        </script>
    </body>
</html>
