<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_basic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_name')->nullable()->comment('商品名称');
            $table->char('goods_sn',20)->nullable()->comment('goods sn');
            $table->string('goods_price')->nullable()->comment('商品价格');
            $table->string('goods_number')->nullable()->comment('商品货号');
            $table->unsignedTinyInteger('unit_type')->default(1)->comment('商品单位1瓶');
            $table->text('description')->nullable()->comment('商品描述');
            $table->string('cover_url')->nullable()->comment('封面图片地址');
            $table->unsignedTinyInteger('status')->default(1)->comment('是否上架1是2否');
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
        Schema::dropIfExists('goods_basic');
    }
}
