<?php

namespace App\Http\Controllers;


use App\Http\Middleware\Benchmark;
use App\Product;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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
        $this->middleware('benchmark:test1,test2', ['except' => ['hello']]);
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
        } catch (\Exception $e) {
            DB::rollBack();
        }

    }

    public function modelTest()
    {
//        $product = Product::query()->create([
//            'title'       => '水杯',
//            'category_id' => 1,
//            'is_on_sale'  => 1,
//            'price'       => '1200',
//            'attr'        => ['高' => '10cm', '容积' => '200ml'],
//        ]);
//        $ret = Product::query()->insert([
//            'title'       => '水杯2',
//            'category_id' => 1,
//            'is_on_sale'  => 1,
//            'price'       => '1200',
//            'attr'        => json_encode(['高' => '10cm', '容积' => '200ml']),
//        ]);//insert 方法不会自动维护时间戳，需要手动维护 也不需要$fillable 自动填充
//        $product = new Product();//创建一个空对象
//        $product->fill([
//            'title'       => '水杯3',
//            'category_id' => 1,
//            'is_on_sale'  => 1,
//            'price'       => '1200',
//            'attr'        => ['高' => '10cm', '容积' => '200ml'],
//        ]);//fill 填充数据
//        $product->title = '水杯4';//赋值的方式填充数据
//        $product->save();//save 保存数据 会自动维护时间戳 会调用insertgetid方法,然后把id填充到 $product 方法里面，最后返回 $product 对象中就会有主键id字段
//        dd($product);
//         查询检索，参考查询构造器
//         $products = Product::all();//查询所有数据
//         $products = Product::query()->get();//查询所有数据
//         $products = Product::query()->where('is_on_sale', 1)->get();
//         dd($products);
//         Product::query()->where('id', 1)->update(['is_on_sale' => 0]);
//         $product        = Product::query()->find(1);
//         $product->title = '保温杯';
//         $product->save();
//         dd($product);
//         $product = Product::query()->find(2);
//         $ret = $product->delete();
//         dd($ret);
//         $product = Product::withTrashed()->find(2);//查询软删除的数据
//         $product->restore();//恢复软删除的数据
//         dd($product);

    }

    public function testCollection()
    {
        // ----------------------------------------获取数据值----------------------------------------
//         $collect = collect([1, 2, 3]);
//         dd($collect->toArray());//转换成数组
//         dd($collect->all());//转换成数组
//         $collect = collect(['k1' => 'v1', 'k2' => 'v2', 'k3' => 'v3']);
//                $keys    = $collect->keys()->toArray();//获取所有的键
//                $values  = $collect->values()->toArray();//获取所有的值
//                dd($keys, $values);
//                dd($collect->last());//获取最后一个值
//         $collect->only(['k1', 'k2'])->dump();//获取指定的键值
        $products = Product::all();
//         $products->pluck('title')->dump();//获取title 这一列数据
//         $products->take(2)->dump();//获取前两条数据
//         dd($collect, $products);
//         dd($products->toJson());//把集合转换成json
//         $ret = $products->pluck('title')->implode(',');//把集合转换成字符串 用逗号分隔开
//        dd($ret);

        // ----------------------------------------聚合运算----------------------------------------
        //        $products = Product::all()->pluck('price');
        //        $products->count();
        //        $products->sum();
        //        $products->average();
        //        $products->max();
        //        $products->min();

        // ----------------------------------------查找判断----------------------------------------
        // $exists = collect(['v1', 'v2', 'v3'])->contains('v4');//判断数组里面是否包含某个值
        // dd($exists);
        // collect([1, 2, 3])->diff([2, 3])->dd();//获取两个数组的差集，差异于array_diff函数一样
        // $collect = collect(['k1' => 'v1', 'k2' => 'v2', 'k3' => 'v3']);
        // $is      = $collect->has('k1');//判断是否包含某个键

        //如何判断一个集合是否为空，不能用empty 直接判断，要用isEmpty
        // $collect = collect([]);
        //        foreach ($collect as $item) {
        //        }
        // dd($collect->isEmpty());//判断集合是否为空

        //集合可以像查询构造器一样链式调用（过滤集合时用很方便）
        // $products = Product::all();
        // $pro      = $products->where('id', 3);//集合用where方法筛选数据
        // dd($pro);

        // ----------------------------------------遍历----------------------------------------
        // $products = Product::all();

        //使用 each 方法进行遍历
        //        $products->each(function ($item) {
        //            var_dump($item->id);
        //        });

        //使用map方法进行遍历
        //        $ret = $products->map(function ($item) {
        //            return $item->id;
        //        });
        // dd($products, $ret->toArray());//map 方法会返回一个新的集合

        //使用keyBy方法把集合转换成以id为键的数组，作用类似于array_column函数，就是从元素中拿出某个字段作为数组的键（常用）
        // $keyBy = $products->keyBy('id')->toArray();
        // dd($products->toArray(), $keyBy);

        //使用groupBy方法把集合转换成以category_id为键的数组（分组）
        // $group = $products->groupBy('category_id');
        // dd($group->toArray());

        //使用filter方法过滤集合 会返回一个新的集合 里面的元素是过滤后的元素 作用类似于array_filter函数 但是array_filter函数返回的是数组，而filter返回的是集合 用起来更方便
        //        $products->filter(function ($item) {
        //            return $item->id > 3;
        //        })->dd();

        // ----------------------------------------对数组本身进行操作的方法----------------------------------------
        // $collect = collect(['k1' => 'v1', 'k2' => 'v2', 'k3' => 'v3']);

        // dd($collect->flip()->toArray());//交换数组的键和值

        // dd($collect->reverse()->toArray());//反转数组

        // collect([12, 4, 5, 2, 77])->sortDesc()->dd();//降序排列

        //        $products = Product::all();
        //        $products->sortByDesc(function ($product) {
        //            return $product->price;
        //        })->dd();//根据价格降序排列   sortByDesc方法会返回一个新的集合

        // collect(['k1', 'k2'])->combine(['v1', 'v2'])->dd();//把两个数组合并成一个数组，第一个数组的值作为键，第二个数组的值作为值，如果两个数组的元素个数不一样，会报错，所以要保证两个数组的元素个数一样
        // collect(['k1', 'k2'])->crossJoin(['v1', 'v2'])->dd();//把两个数组合并成一个数组，笛卡尔集，排列组合
    }

    public function cacheTest()
    {
        // ----------------------------------------缓存----------------------------------------
        // 添加缓存Cache facade 门面缓存
        Cache::put('key1', 'value1', 10);//10分钟后过期
        Cache::put('key2', 'value2');//永不过期，不加时间参数
        Cache::put('key3', 'value3', now()->addMinutes(1));//1分钟后过期，相对时间，在当前时间上加1分钟

//        // 获取缓存
        $v1 = Cache::get('key1', 'default1');//通过key获取缓存，如果key不存在，则返回默认值
        $v2 = Cache::get('key2', 'default2');
        $v3 = Cache::get('key3', 'default3');

        $is = Cache::has('key3');//判断缓存是否存在

        // 如果key存在，则存储失败
        $is = Cache::add('key2', 'value', 10);
        $is = Cache::add('key4', 'value4', 10);

        // 永久存储 不建议使用，缓存一定要加过期时间，不然如果数据量比较大，很难维护
        Cache::forever('key5', 'value5');

        // 删除缓存
        Cache::forget('key2');
        Cache::put('key5', '', 0);//设置缓存过期时间为0，相当于删除缓存

        // 计数
        Cache::increment('key6', 1);//如果key不存在，则会创建一个key，值为1
        Cache::increment('key6', 1);//如果key存在，则会在原来的基础上加1
        Cache::decrement('key6', 2);//如果key存在，则会在原来的基础上减2
        $v6 = Cache::get('key6');

        // 获取并删除
        Cache::forever('key7', 'value7');//永久存储
        $v7 = Cache::pull('key7');//获取并删除缓存

        // 获取缓存，缓存失效自动获取数据
        Cache::remember('key8', 60, function () {//如果缓存不存在，则获取数据
            // todo ...
            return ['xxx'];//返回的数据会被缓存
        });

//        $cache = Cache::get('key8');//获取缓存
//        if (is_null($cache)) {//如果缓存不存在，则获取数据
//            // todo ...
//            $cache = ['xxx'];
//            Cache::put('key8', $cache, 60);//存储缓存
//        }
    }
//
//    public function facadeTest()
//    {
//        Product::getProduct(123);
//    }
}
