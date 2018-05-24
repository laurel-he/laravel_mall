<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToInventorySystem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory_system', function (Blueprint $table) {
            $table->string('entry_at')->nullable()->after('inventory_min')->comment('入库时间');
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
            $table->dropColumn('entry_at');
        });
    }
}
