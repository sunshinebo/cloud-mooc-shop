<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

/**
 * 中间件
 * 检测应用程序执行时间
 */
class Benchmark
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request 请求
     * @param \Closure $next 业务逻辑，想要取处理的reques 的业务逻辑 next 是一个闭包函数
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $a, $b)
    {
        //把request 传给闭包函数 next，返回一个response
        //前置(程序运行之前) 逻辑标记应用程序进来时的时间戳
        //获取开始时间
        $sTime = microtime(true);

        $response = $next($request);

        //后置（程序运行之后）
        //获取运行时间
        $runTime = microtime(true) - $sTime;

        //记录应用程序日志
        Log::info('benchmark', [
            'url'     => $request->url(),
            'a'       => $a,
            'b'       => $b,
            'input'   => $request->input(),
            'runTime' => "$runTime ms",
        ]);

        return $response;
    }
}
