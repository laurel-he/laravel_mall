<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnToInventorySystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_system', function (Blueprint $table) {
            $table->unsignedInteger('inventory_min')->default(0)->after('destroy_count')->comment('库存最小量');
            $table->unsignedInteger('inventory_max')->default(0)->after('destroy_count')->comment('库存最大量');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory_system', function (Blueprint $table) {
            $table->dropColumn(['inventory_min','inventory_max']);
        });
    }
}
