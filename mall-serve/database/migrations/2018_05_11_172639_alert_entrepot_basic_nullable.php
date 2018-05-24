<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlertEntrepotBasicNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('entrepot_basic', function (Blueprint $table) {
            $table->string('contact')->nullable()->change();
            $table->string('contact_phone')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('comment')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('entrepot_basic', function (Blueprint $table) {
            $table->dropColumn(['contact','contact_phone','address','comment']);
        });
    }
}
