<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDepositRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('操作员工');
            $table->unsignedInteger('target_id')->comment('目标员工');
            $table->string('event_type',20)->comment('事件类型 像下单扣款 充值等');
            $table->decimal('money')->comment('金额');
            $table->string('brief',200)->nullable()->comment('简述');
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
        Schema::dropIfExists('deposit_record');
    }
}
