<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserBasic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_basic', function (Blueprint $table) {
            $table->decimal('deposit_money', 8, 2)->default('0.00')->comment('保证金')->after('group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_basic', function (Blueprint $table) {
            $table->dropColumn('deposit_money');
        });
    }
}
