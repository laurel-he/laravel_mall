<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTalbeAfterSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_after_sale', function (Blueprint $table) {
            $table->unsignedInteger('cus_id')->nullable()->comment('客户ID')->after('order_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_after_sale', function (Blueprint $table) {
            $table->dropColumn('cus_id');
        });
    }
}
