<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 数据填充的逻辑写在run方法里
     *
     * @return void
     */
    public function run()
    {
        //填充users表数据
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name'       => 'leon',
            'email'      => 'xxx@163.com',
            'password'   => bcrypt('123456'),
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);
    }
}
