<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;//软删除
    // UserAddress user_address 蛇形命名
//    protected $table = 'product';
//    protected $connection = 'mysql';
//    protected $primaryKey = 'id';

    //created_at updated_at
//    public $timestamps = true;
//    const CREATED_AT = 'add_time';
//    const UPDATED_AT = 'update_time';

    protected $casts = [
        'attr' => 'array',//将attr字段转为数组
    ];//转换字段的类型

    //指定允许的字段进行数据填充 也就是字段填充的白名单
    protected $fillable = [
        'title',
        'category_id',
        'is_on_sale',
        'pic_url',
        'price',
        'attr',
    ];

//    protected $guarded = []; //指定不允许的字段进行数据填充 也就是字段填充的黑名单 ,黑名单和白名单不能同时出现，如果只出现黑名单而且是空数组的话，表示所有字段不允许填充的意思

}
