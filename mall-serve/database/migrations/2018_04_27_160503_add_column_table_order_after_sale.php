<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTableOrderAfterSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_after_sale', function (Blueprint $table) {
            $table->unsignedInteger('entrepot_id')->nullable()->comment('nullable 主要是为了alter时不报错');
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
            $table->dropColumn('entrepot_id');
        });
    }
}
