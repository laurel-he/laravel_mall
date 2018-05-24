<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUserBasic2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_basic', function (Blueprint $table) {
            $table->dropColumn("status");

        });

        Schema::table('user_basic', function (Blueprint $table) {
            $table->tinyInteger('status')->default(1)->comment('状态 1 -1');

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
            //
        });
    }
}
