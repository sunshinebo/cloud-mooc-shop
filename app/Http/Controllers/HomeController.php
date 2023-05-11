<?php

namespace App\Http\Controllers;


use App\Http\Middleware\Benchmark;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function __construct()
    {
        //except 黑名单
        //only 白名单
        //benchmark:test1,test2 传参 传递给中间件 用逗号隔开 传递给中间件的参数 用冒号隔开
        //如何接受中间件传递过来的参数 去benchmark中间件中接受
        $this->middleware('benchmark:test1,test2', ['only' => ['hello']]);
    }

    public function hello()
    {
        return "Hello World!";
    }

    public function hello2()
    {
        return "Hello2 World2!";
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

    public function dbTest()
    {
        //查询
        $users = DB::select('select * from users');
//        $users = DB::select('select * from users where id = ?', [1]);//占位符
//        $users = DB::select('select * from users where id = :id', ['id' => 1]);//命名占位符不用考虑顺序
        //写入
//        $ret = DB::insert('insert into users (name,email,password) values (?,?,?)', ['leon01', 'leon01@163.com', bcrypt('123456')]);
        //更新
//        $ret = DB::update('update users set email = ? where id = ?', ['xxx01@163.com', 4]);
        //删除
//        $ret = DB::delete('delete from users where id = ?', [4]);
//        dd($ret);
        //删除表结构
//        DB::statement('drop table users');

        //获取查询结果
//        $users = DB::table('users')->where('id', 1)->get();//返回集合 对象
//        $users = DB::table('users')->find(1);//find 通过主键查找
//        $users = DB::table('users')->where('id', 1)->first();
//        $users = DB::table('users')->where('id', 1)->value('name');//返回单个值
//        $users = DB::table('users')->pluck('name')->toArray();//获取一列的数据
//        $users = DB::table('users')->get();
//        $users = DB::table('users')->paginate(2);//分页 传入每一页的数据数量
//        分页 传入每一页的数据数量,唯一区别少了total，没有统计数据库里用户的数量，只是返回一个hasMore函数，没有下一页，为什么需要这样区分，假如还说我们的数据库里面的量非常的大，我们不需要统计总数，只需要知道是否有下一页，就可以使用simplePaginate，比如说有几亿的数据这时候我们用count查询我们数据库里的数据是非常慢的会直接产生一条mysql导致整个查询直接被堵住，直接造成线上事故，所以说我们大表是不允许count的，所以有些线上场景是不允许查出所有数量的这时候我们就可以使用simplePaginate，来查询分页结果
//        $users = DB::table('users')->simplePaginate(2);

        //聚合查询
//        $users = DB::table('users')->max('id');//最大值
//        $users = DB::table('users')->min('id');//最小值
//        $users = DB::table('users')->avg('id');//返回的是一个字符串 平均值
//        $users = DB::table('users')->count('id');//统计数量
//        $users = DB::table('users')->sum('id');//求和
//        $users = DB::table('users')->where('id', 1)->exists();//where默认情况下中间操作的等号是可以省略掉的，不是等号的话就不能省略掉，判断一条数据是不是存在
//        $users = DB::table('users')->where('id', 1)->doesntExist();//返回true，直接判断一条数据不存在

        //where 语句
//        //select * from users where id > 1;
//        DB::table('users')->where('id', '>', 1)->dump();
//        //select * from users where id <> 1;
//        DB::table('users')->where('id', '<>', 1)->dump();
//        //select * from users where name like 'leon%';
//        DB::table('users')->where('name', 'like', 'leon%')->dump();
//        //select * from users where name like '%leon';
//        DB::table('users')->where('name', 'like', '%leon')->dump();
//        //select * from users where id >1 or name like 'leon%';
//        DB::table('users')->where('id', '>', 1)->orWhere('name', 'like', 'leon%')->dump();
//        //select * from users where id >1 and (email like '%@163' or name like 'leon%');
//        DB::table('users')->where('id', '>', 1)->where(function (Builder $query) {
//            $query->where('email', 'like', '%@163')
//                ->orWhere('name', 'like', 'leon%');
//        })->dump();
//        //select * from users where id in (1,2,3);
//        DB::table('users')->whereIn('id', [1, 2, 3])->dump();
//        //select * from users where id not in (1,2,3);
//        DB::table('users')->whereNotIn('id', [1, 2, 3])->dump();
//        //select * from users where created_at is null;
//        DB::table('users')->whereNull('created_at')->dump();
//        //select * from users where created_at is not null;
//        DB::table('users')->whereNotNull('created_at')->dump();
//        //select * from users where `name` = `email`;
//        DB::table('users')->whereColumn('name', 'email')->dump();//whereColumn 两个字段之间的比较

//        $ret = DB::table('users')->insert([
//            'name' => 'name1',
//            'password'  => Hash::make('123456'),
//            'email' => 'name1@163.com'
//        ]);//新增单个数据
//
//        $ret = DB::table('users')->insert([
//            [
//                'name' => 'name2',
//                'password'  => Hash::make('123456'),
//                'email' => 'name2@163.com'
//            ],
//            [
//                'name' => 'name3',
//                'password'  => Hash::make('123456'),
//                'email' => 'name3@163.com'
//            ]
//        ]);//新增多个数据
//        $ret = DB::table('users')->insertOrIgnore([
//            [
//                'name' => 'name1',
//                'password'  => Hash::make('123456'),
//                'email' => 'name1@163.com'
//            ]
//
//        ]);//忽略重复写入的错误
//
//        $ret = DB::table('users')->insertGetId([
//            'name' => 'name4',
//            'password'  => Hash::make('123456'),
//            'email' => 'name4@163.com'
//        ]); //获取写入之后返回的主键id
//
//
//        $ret = DB::table('users')->where('id', 1)->update([
//            'name' => 'tom',
//            'password'  => Hash::make('123456'),
//            'email' => 'tom@163.com'
//        ]); //更新数据
//        $ret = DB::table('users')->updateOrInsert([
//            ['id'=>10],
//            [
//                'name' => 'name6',
//                'password'  => Hash::make('123456'),
//                'email' => 'tom@163.com'
//            ]
//        ]);//更新数据，如果没有更新到数据，就插入一条新的数据
//        $ret = DB::table('users')->where('id', 1)->increment('score', 1);//自增
//        $ret = DB::table('users')->where('id', 1)->decrement('score', 1);//自减
//
//        $ret = DB::table('users')->where('id', 7)->delete();//删除数据
//
//        $ret = DB::table('users')->truncate();//清空数据表

        //事物
        //1.必包，自动提交、回滚
        DB::transaction(function () {
            DB::table('users')->where('id', 7)->update(['name' => Str::random()]);
            DB::table('users')->where('id', 9)->update(['name' => Str::random()]);
        });
        //2.手动 自行提交、回滚 并做异常处理
        try {
         DB::beginTransaction();
            DB::table('users')->where('id', 7)->update(['name' => Str::random()]);
            DB::table('users')->where('id', 9)->update(['name' => Str::random()]);
        }catch (\Exception $e) {
            DB::rollBack();
        }

    }
}
