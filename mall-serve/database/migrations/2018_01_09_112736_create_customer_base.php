<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerBase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_basic', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->string('name',20)->comment('客户姓名');
            $table->unsignedTinyInteger('sex')->default(0)->comment('0 未定义 1 男 2 女');
            $table->string('age', 20)->comment('客户年龄');
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
        Schema::dropIfExists('customer_base');
    }
}
