<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableGoodsBasic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_basic', function (Blueprint $table) {
            $table->unsignedTinyInteger('new_goods')->default(0)->comment('新品首发');
            $table->unsignedTinyInteger('hot_goods')->default(0)->comment('畅销精品');
            
            $table->decimal('del_price')->default('0.00')->comment('原价');
            $table->unsignedMediumInteger('comments')->default(0)->comment('评价数');
            $table->unsignedMediumInteger('sale_count')->default(0)->comment('累积销售');
            $table->unsignedMediumInteger('sale_able_count')->default(0)->comment('库存');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods_basic', function (Blueprint $table) {
            $table->dropColumn(['new_goods','hot_goods','del_price','comments','sale_count','sale_able_count']);
        });
    }
}
