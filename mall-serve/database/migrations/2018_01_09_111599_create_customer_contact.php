<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerContact extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_contact', function (Blueprint $table) {
            $table->increments('id')->comment('ID');
            $table->unsignedInteger('cus_id')->comment('客户ID');
            $table->string('phone', 20)->comment('客户手机号');
            $table->string('qq', 20)->comment('客户QQ号');
            $table->string('qq_nickname', 20)->comment('客户QQ昵称');
            $table->string('weixin', 20)->comment('客户微信号');
            $table->string('weixin_nickname', 20)->comment('客户微信昵称');
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
        Schema::dropIfExists('customer_contact');
    }
}
