<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableExpressInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn',10)->comment('编号 AS00000001');
            $table->string('express_sn',50)->comment('快递单号');
            $table->string('express_name', 20)->comment('快递公司');
            $table->string('user_name',20)->comment('寄件人');
            $table->timestamp('express_at')->comment('快递时间');
            $table->string('deliver_name',20)->comment('收货人姓名');
            $table->string('deliver_phone',20)->comment('联系方式 一般是手机');
            $table->string('deliver_address',100)->comment('收货地址');
            $table->mediumText('goods')->comment(' 化的清单');
            $table->string('create_by',20)->comment('打印单生成员');
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
        Schema::dropIfExists('express_invoices');
    }
}
