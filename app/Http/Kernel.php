<?php

namespace App\Http;

use App\Http\Middleware\Benchmark;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *  全局中间件
     *  每一个http请求都会经过这里进行处理
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,//客户端和服务器之间存在代理服务器的时候,需要配置这个中间件
        \Fruitcake\Cors\HandleCors::class,//跨域请求中间件
        \App\Http\Middleware\CheckForMaintenanceMode::class,//维护模式中间件，比如显示一个站点维护中，多少分钟后维护完成可以用这个
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,//验证post请求的数据大小
        \App\Http\Middleware\TrimStrings::class,//去除请求数据两边的空格
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,//把空字符串转换成null
    ];

    /**
     * The application's route middleware groups.
     * 中间件组 可以把 路由中间件分组放在这里
     * 这里声明的也是路由中间件
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,//加密cookie
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,//把cookie添加到响应中
            \Illuminate\Session\Middleware\StartSession::class,//开启session
//             \Illuminate\Session\Middleware\AuthenticateSession::class,//验证session
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,//把session中的错误信息共享给视图
//            \App\Http\Middleware\VerifyCsrfToken::class,//验证csrf令牌，防止跨站请求伪造攻击，就是请求里必须带上框架给你的token，而且token被验证合法才能访问，保证请求安全，线上如果是api访问，不需要带上csrftoken，如果是web访问，需要带上csrftoken，在页面上把这个token打印出来，然后在请求里带上这个token把这个token待回来，这样就可以访问了，这样访问就更安全了
            \Illuminate\Routing\Middleware\SubstituteBindings::class,//绑定模型
        ],

        'api' => [
            'throttle:60,1',//限制api访问频率，60秒内只能访问1次
            \Illuminate\Routing\Middleware\SubstituteBindings::class,//绑定模型
        ],
    ];

    /**
     * The application's route middleware.
     * 路由中间件
     *
     * auth、auth.basic、can、guest 用来做鉴权的
     * throttle 用来做限流的
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,//验证用户是否登录
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,//基本的http认证
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,//绑定模型
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,//设置缓存头信息
        'can' => \Illuminate\Auth\Middleware\Authorize::class,//授权
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,//如果用户已经登录，那么就跳转到指定的页面
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,//确认密码
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,//验证签名
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,//限制请求次数
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,//验证邮箱
        'benchmark' => Benchmark::class,//验证路由响应时间
    ];

    //中间件优先级,如果想把中间件放在全局中间件之前，可以在这里进行配置
    //比如说我们的benchmark中间件，我们想让他在全局中间件之前执行，那么我们就可以在这里进行配置
    //在这里标记先后顺序，越上面权重就越高，越优先执行
    protected $middlewarePriority = [];
}
