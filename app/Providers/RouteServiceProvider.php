<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

/**
 * 路由分组
 *
 * 比如说api 分为 管理员的api 和 普通用户的 api
 * 这个时候我们进行用户鉴权的方式是不一样的，等于说我们的中间件可能是不一样的
 * 这个时候我们就需要把这个两个路由进行分组，分别对他的中间件进行管理
 * 我们可以传不同的中间件进来，然后进行不同的用户权限的验证，也可以加不同的前缀
 * 比如说api路由直接就加api前缀，然后我们的管理员的admin路由就加admin前缀
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * 其实对应的route目录中的api.php和web.php文件已经admin.php文件
     *
     * @return void
     */
    public function map()
    {
        //路由分组api
        $this->mapApiRoutes();

        //路由分组web
        $this->mapWebRoutes();

        //路由分组admin
        $this->mapAdminRoutes();

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->middleware('admin')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }
}
