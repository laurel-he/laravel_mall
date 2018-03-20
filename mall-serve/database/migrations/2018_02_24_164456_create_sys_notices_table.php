<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_notices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('公告标题');
            $table->unsignedInteger('type_id')->comment('公告类型ID');
            $table->unsignedInteger('user_id')->comment('发布人ID');
            $table->string('content',255)->comment('公告内容');
            $table->string('start_time')->nullable()->comment('开始时间');
            $table->string('end_time')->nullable()->comment('截止时间');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sys_notices');
    }
}
