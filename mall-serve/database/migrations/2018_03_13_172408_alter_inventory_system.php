<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterInventorySystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_system', function(Blueprint $table){
            $table->unique(['entrepot_id', 'sku_sn'], 'entrepot_productsn_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_system', function(Blueprint $table){
           $table->dropUnique('entrepot_productsn_index'); 
        });
    }
}
