<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertExpressCompaniesNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('express_companies', function (Blueprint $table) {
            $table->string('contact_name')->nullable()->change();
            $table->string('contact_tel')->nullable()->change();
            $table->string('remark')->nullable()->change();
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
            $table->dropColumn(['contact_name','contact_tel','remark']);
        });
    }
}
