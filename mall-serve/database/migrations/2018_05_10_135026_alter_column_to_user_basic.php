<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnToUserBasic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_basic', function (Blueprint $table) {
            $table->string('card_img')->after('deposit_money')->nullable()->comment('手持身份证照');
            $table->string('card_front')->after('card_img')->nullable()->comment('身份证正面照');
            $table->string('card_back')->after('card_front')->nullable()->comment('身份证反面照');
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
            $table->dropColumn(['card_img','card_front','card_back']);
        });
    }
}
