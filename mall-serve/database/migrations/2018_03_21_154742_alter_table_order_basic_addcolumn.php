<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrderBasicAddcolumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_basic', function (Blueprint $table) {
            $table->unsignedInteger('status')->default(0)->comment('订单状态 旧的作废了');
            $table->unsignedInteger('product_status')->default(0)->comment('货物状态 旧的sipping_status作废');
            $table->unsignedInteger('after_sale_status')->default(0)->comment('售后状态');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_basic', function (Blueprint $table) {
            $table->dropColumn(['status', 'product_status', 'after_sale_status']);
        });
    }
}
