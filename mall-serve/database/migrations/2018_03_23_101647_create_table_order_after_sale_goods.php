<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderAfterSaleGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_after_sale_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('after_sale_id')->comment('关联ID');
            $table->unsignedInteger('goods_id')->commet('商品ID');
            $table->char('sku_sn', SKU_SN_LENGTH)->comment('商品编号');
            $table->unsignedInteger('goods_num')->default(0)->comment('数量');
            $table->string('unit_type',10)->comment('单位');
            $table->unsignedTinyInteger('type')->comment('0 退货 1换货退回  2 换货发货');
            $table->string('remark', 100)->nullable()->comment('备注');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_after_sale_goods');
    }
}
