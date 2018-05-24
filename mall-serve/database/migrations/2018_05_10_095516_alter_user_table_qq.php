<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUserTableQq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_basic', function (Blueprint $table) {
//             $table->char('qq',20)->nullable()->comment('qq号')->change();
               $table->dropColumn('qq');
        });
        
            Schema::table('user_basic', function (Blueprint $table) {
                $table->char('qq',20)->nullable()->comment('qq号')->after('password');
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
