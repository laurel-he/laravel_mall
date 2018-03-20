<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UploadResource extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_resource', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('type')->comment('上传文件类型');
            $table->string('size')->comment('上传文件大小');
            $table->string('file_name', 50)->comment('原文件名');
            $table->string('path')->comment('文件路径');
            $table->string('url')->comment('文件url');
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
        Schema::dropIfExists('upload_resource');
    }
}
