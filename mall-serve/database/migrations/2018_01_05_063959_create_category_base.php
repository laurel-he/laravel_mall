<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_base', function (Blueprint $table) {
            $table->increments('id')->comment('商品类型ID');
            $table->unsignedInteger('type_id')->comment('商品分类ID')->nullable();
            $table->string('label')->comment('商品类型名称');
            $table->unsignedInteger('pid')->defaule(0)->comment('商品类型父ID');
            $table->unsignedTinyInteger('level')->defaule(1)->comment('商品类型等级');
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
        Schema::dropIfExists('category_base');
    }
}
