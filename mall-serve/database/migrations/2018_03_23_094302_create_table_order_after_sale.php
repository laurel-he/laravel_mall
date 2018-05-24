<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrderAfterSale extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_after_sale', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('user_id')->comment('发起员工id');
            $table->string('user_name',20)->comment('发起员工 姓名');
            $table->unsignedInteger('group_id')->comment('小组id');
            $table->unsignedInteger('department_id')->comment('部门id');
            $table->unsignedTinyInteger('type')->comment('0退货 1换货');
            $table->unsignedTinyInteger('check_status')->default(0)->comment('审核状态 0待审核 1通过 2不通过');
            $table->string('check_remark', 100)->nullable()->comment('审核 原因');
            
            $table->string('remark', 100)->nullable()->comment('备注 100字');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_after_sale');
    }
}
