<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrderBasicAddCusName extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_basic', function (Blueprint $table) {
            $table->string('cus_name',20)->nullable()->comment('客户姓名');
            $table->unsignedInteger('group_id')->default(0)->comment('小组id');
            $table->unsignedInteger('department_id')->default(0)->comment('部门id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_basic', function (Blueprint $table) {
            $table->dropColumn(['cus_name','group_id','department_id']);
        });
    }
}
