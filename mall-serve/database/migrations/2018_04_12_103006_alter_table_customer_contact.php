<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCustomerContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_contact', function (Blueprint $table) {
            $table->string('phone', 20)->nullable()->change();
            $table->string('qq', 20)->nullable()->change();
            $table->string('weixin', 20)->nullable()->change();
            $table->string('qq_nickname', 20)->nullable()->change();
            $table->string('weixin_nickname', 20)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_contact', function (Blueprint $table) {
            //
        });
    }
}
