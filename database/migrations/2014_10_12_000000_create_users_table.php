<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', '100')->comment('用户名');
            $table->string('email')->unique()->comment('邮箱');
            $table->timestamp('email_verified_at')->nullable()->comment('邮箱验证时间');
            $table->string('password')->comment('密码');
            $table->rememberToken()->default('')->comment('记住我');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * down 表示回滚的时候执行的方法
     * 如何消除这张表
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');//dropIfExists 表示如果这这表存在就把他删除掉
    }
}
