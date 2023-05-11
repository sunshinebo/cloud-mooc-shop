<?php

namespace App\Http\Controllers;


use App\Http\Middleware\Benchmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        //except 黑名单
        //only 白名单
        //benchmark:test1,test2 传参 传递给中间件 用逗号隔开 传递给中间件的参数 用冒号隔开
        //如何接受中间件传递过来的参数 去benchmark中间件中接受
        $this->middleware('benchmark:test1,test2',['only'=>['hello']]);
    }

    public function hello()
    {
        return "Hello World!";
    }

    public function hello2()
    {
        return "Hello2 World2!";
    }

    public function dbTest()
    {
        DB::select('select * form user');
    }

    public function getOrder($id, $name)
    {
//        $query = $request->query();
//        $post = $request->post();
//        return ['query'=>$query,'post'=>$post];
        return [$id, $name];
    }

    public function getUser(Request $request)
    {
        return $request->input('id');
    }
}
