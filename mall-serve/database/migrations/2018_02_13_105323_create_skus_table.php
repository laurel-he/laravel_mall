<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_sku', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 40)->nullable()->comment('sku 名称');
            $table->char('sku_sn',50)->nullable()->comment('sku sn 对应库存里的商品编号');
            $table->unsignedInteger('goods_id')->comment('商品ID');
            $table->unsignedMediumInteger('num')->comment('存库数量');
            $table->unsignedDecimal('price')->comment('价格')->default('0.00');
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
        Schema::dropIfExists('goods_sku');
    }
}
