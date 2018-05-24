<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderAfterSaleExpress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_after_sale_express', function (Blueprint $table) {
            $table->increments('id');
            $table->string('express_sn',50)->comment('快递号');
            $table->unsignedInteger('after_sale_id')->comment('关联的ID');
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
        Schema::dropIfExists('order_after_sale_express');
    }
}
