<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    | Supported: "apc", "array", "database", "file",
    |            "memcached", "redis", "dynamodb"
    |
    | apc 本地缓存 不维护了 不使用
    | array 使用我们的内存作为我们缓存
    | database 使用数据库作为缓存,需要预先生产一个表，用来存储键值对
    | file 使用文件作为缓存 文件缓存有一定的使用场景，当我们的服务体量比较小的时候，不需要外部的这些缓存  可以使用文件缓存，把一些复杂的 一些数据结构，存储到文件里面，这样就可以了
    |
    | "memcached", "redis", "dynamodb" 这三种都是分布式缓存，都可以应用于大型的分布式应用中
    | memcached 是一个内存缓存，所有数据都存储在内存中的，所以它一旦重启，所有的数据都会丢失，所以它一般用来存储一些临时的数据，比如一些验证码，一些短信验证码，一些临时的数据，这些数据不需要长期存储，不需要持久化，就可以使用memcached
    | redis 可以将它的缓存数据持久化到硬盘中 （常用缓存）
    | dynamodb 是一个亚马逊的一个云服务，它是一个分布式的缓存，它的性能非常好，但是它的价格也非常贵，所以一般我们不会使用它
    */

    'default' => env('CACHE_DRIVER', 'file'),//默认使用file缓存,CACHE_DRIVER 缓存驱动

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    */

    'stores' => [

        'apc' => [
            'driver' => 'apc',//配置很简单只需要一个缓存驱动
        ],

        //数组缓存
        'array' => [
            'driver' => 'array',//配置很简单只需要一个缓存驱动
            'serialize' => false,//是否序列化 默认不序列化
        ],

        //数据库缓存
        'database' => [
            'driver' => 'database',//驱动
            'table' => 'cache',//表名，就是要把key 和 value 存储到哪里，这里表示cache这张表
            'connection' => null,//连接 默认是null，表示使用数据库默认的连接
        ],

        //文件缓存
        'file' => [
            'driver' => 'file',//驱动
            'path' => storage_path('framework/cache/data'),//文件缓存的路径，目录是在storage/framework/cache/data
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID'),
            'sasl' => [
                env('MEMCACHED_USERNAME'),
                env('MEMCACHED_PASSWORD'),
            ],
            'options' => [
                // Memcached::OPT_CONNECT_TIMEOUT => 2000,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', '127.0.0.1'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],

        'redis' => [
            'driver' => 'redis',//驱动
            'connection' => 'cache',//连接，这里表示使用cache这个连接，对应的配置在config/database.php里面的cache配置
        ],

        'dynamodb' => [
            'driver' => 'dynamodb',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'table' => env('DYNAMODB_CACHE_TABLE', 'cache'),
            'endpoint' => env('DYNAMODB_ENDPOINT'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing a RAM based store such as APC or Memcached, there might
    | be other applications utilizing the same cache. So, we'll specify a
    | value to get prefixed to all our keys so we can avoid collisions.
    |
    */

    //缓存前缀配置 默认值是laravel_cache 这个前缀是为了防止缓存冲突，如果我们的缓存是存储在内存中的，那么我们的缓存是共享的，如果我们的缓存的key是一样的，那么就会出现冲突，所以我们需要给我们的缓存加一个前缀，这样就可以避免冲突了
    'prefix' => env('CACHE_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_cache'),

];
