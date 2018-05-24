<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOperateOrderRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operate_order_record', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('order_id')->comment('订单ID');
//             $table->unsignedInteger($column)
            $table->string('action_name', 30)->comment('操作名称');
            $table->string('user_name', 20)->comment('操作员工');
            $table->unsignedInteger('user_id')->comment('操作员工ID');
            $table->string('remark', 100)->comment('操作备注');
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
        Schema::dropIfExists('operate_order_record');
    }
}
