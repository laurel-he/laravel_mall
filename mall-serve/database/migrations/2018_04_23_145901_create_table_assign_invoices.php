<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAssignInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sn',10)->comment('编号 aa00000001');
            $table->string('entrepot_name',20)->comment('发货单位 配送中心');
            $table->string('user_name',20)->comment('发货人');
            $table->char('assign_sn',16)->comment('发货单号');
            $table->timestamp('assign_at')->comment('发货时间');
            $table->string('deliver_name',20)->comment('收货人姓名');
            $table->string('deliver_phone',20)->comment('联系方式 一般是手机');
            $table->string('deliver_address',100)->comment('收货地址');
            $table->mediumText('goods')->comment('化的清单');
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
        Schema::dropIfExists('assign_invoices');
    }
}
