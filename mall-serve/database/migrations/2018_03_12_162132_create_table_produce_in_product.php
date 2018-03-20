<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProduceInProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //生产入库  子表
        Schema::create('produce_in_product', function(Blueprint $table){
            $table->increments('id');
            $table->string('cate_type')->comment('商品类型');
            $table->string('cate_kind')->comment('商品品种');
            $table->unsignedInteger('cate_type_id')->comment('商品类型id');
            $table->unsignedInteger('cate_kind_id')->comment('商品品种id');
            $table->unsignedTinyInteger('product_sale_type')->comment('销售类型 试用装 赠品 成品');
            $table->string('goods_name')->comment('商品名称');
            $table->char('sku_sn',50)->comment('商品编号');
            $table->unsignedInteger('num')->comment('商品数量');
            $table->unsignedInteger('parent_id')->comment('父表id');
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
        Schema::drop('produce_in_product');
    }
}
