<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAfterSaleGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_after_sale_goods', function (Blueprint $table) {
            $table->string('goods_name', 20)->nullable()->comment('商品名称');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_after_sale_goods', function (Blueprint $table) {
            $table->dropColumn('goods_name');
        });
    }
}
