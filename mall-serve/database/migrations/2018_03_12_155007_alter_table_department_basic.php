<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDepartmentBasic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('department_basic', function (Blueprint $table) {
            $table->unsignedInteger('entrepot_id')->default(0)
                  ->comment('配送中心')->after('manager_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('department_basic', function (Blueprint $table) {
            $table->dropColumn(['entrepot_id']);
        });
    }
}
