<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spec_type', function (Blueprint $table) {
            $table->integer('type_id')->unsigned();
        	$table->integer('spec_id')->unsigned();
        	
            $table->foreign('type_id')->references('id')->on('goods_type')
            ->onUpdate('cascade')->onDelete('cascade');
        	$table->foreign('spec_id')->references('id')->on('goods_specs')
        	->onUpdate('cascade')->onDelete('cascade');
        	
        	$table->primary(['spec_id', 'type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spec_type');
    }
}
