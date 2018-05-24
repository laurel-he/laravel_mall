<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAfterGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_after_sale_goods', function (Blueprint $table) {
            $table->unsignedTinyInteger('goods_status')->default(0)->comment('货物状态 0完好 1损坏');
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
            $table->dropColumn('goods_status');
        });
    }
}
