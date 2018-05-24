<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableExpressCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('express_companies', function (Blueprint $table) {
            $table->char('eng',2)->nullable()->unique()->comment('两个英文字母 大写的');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('express_companies', function (Blueprint $table) {
            $table->dropColumn('eng');
        });
    }
}
