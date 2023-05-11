<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     * failed_jobs
     * 失败队列表
     * 如果laravel 投递任务失败会在这张表里下一条消息
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->text('connection')->comment('连接名称');
            $table->text('queue')->comment('队列名称');
            $table->longText('payload')->comment('任务的内容');
            $table->longText('exception')->comment('失败原因');
            $table->timestamp('failed_at')->useCurrent()->comment('失败时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
    }
}
