<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommunicatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('communicates', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('communicate_time')->nullable()->comment('沟通时间');
            $table->string('contact_content',300)->nullable()->comment('沟通明细');
            $table->string('user_name',20)->nullable()->comment('沟通员工');
            $table->unsignedInteger('user_id')->nullable()->comment('沟通员工ID');
            $table->unsignedInteger('assign_id')->nullable()->comment('assign_basic表ID');
            $table->string('cus_name',20)->nullable()->comment('客户姓名');
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
        Schema::dropIfExists('communicates');
    }
}
