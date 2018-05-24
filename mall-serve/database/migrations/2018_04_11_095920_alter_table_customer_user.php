<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableCustomerUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_user', function (Blueprint $table) {
            $table->timestamp('last_track')->nullable()->comment('上次跟踪时间');
            $table->timestamp('plan')->nullable()->comment('计划');
            $table->timestamp('last_conflict')->nullable()->comment('最后一次冲突');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_user', function (Blueprint $table) {
            $table->dropColumn(['last_track', 'plan', 'last_conflict']);
        });
    }
}
