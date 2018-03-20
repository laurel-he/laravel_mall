<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkuAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	// goods_specs
        Schema::create('sku_attrs', function (Blueprint $table) {
        	$table->unsignedInteger('sku_id');
        	$table->unsignedInteger('spec_id');
        	$table->unsignedInteger('goods_id');
        	$table->string('value','40')->nullable();
        	$table->string('addon_value', 255)->nullable();
        	
        	$table->primary(['sku_id', 'spec_id']);
        	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sku_attrs');
    }
}
