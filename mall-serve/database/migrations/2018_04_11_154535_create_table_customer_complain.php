<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomerComplain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_complain', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cus_id')->nullable()->comment('客户ID');
            $table->string('cus_name',50)->nullable()->comment('客户姓名');
            $table->unsignedInteger('user_id')->nullable()->comment('录入员工ID');
            $table->string('user_name',50)->nullable()->comment('录入人姓名');
            $table->unsignedTinyInteger('type')->nullable()->comment('投诉类型');
            $table->string('content')->nullable()->comment('投诉内容');
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
        Schema::dropIfExists('customer_complain');
    }
}
