
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap-sass');
} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * ^2_3^
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo';
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key',
//     cluster: 'mt1',
//     encrypted: true
// });
//
//// Laravel5.5_事件广播系统-Redis广播器(结合Redis队列)+LaravelEchoServer(作为Socket.IO服务器/WebSocket服务器)+LaravelEcho客户端；
// 问题：有时无法从resources/assets/js/bootstrap.js或者resources/assets/js/app.js中的laravel-echo编译进public/js/app.js文件。
// 解决：在webpack.mix.js文件中添加"mix.js('resources/assets/js/laravelecho.js', 'public/js');"，执行"npm run dev"重新编译脚本，
//这样resources/assets/js/laravelecho.js文件会被编译到public/js/laravelecho.js，当然resources/assets/js/laravelecho.js文件内容
//为laravel-echo实例化脚本，如下。
import Echo from "laravel-echo";
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});