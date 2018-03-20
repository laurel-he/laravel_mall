<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_info', function (Blueprint $table) {
//             $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('cus_id')->nullable()->comment('客户ID');
            $table->string('order_sn',20)->comment('订单号');
            $table->string('express_sn',20)->comment('运单号');
            $table->string('express_name',20)->comment('快递名');
            $table->unsignedTinyInteger('express_status')->default(0)->comment('快递状态0未发货');
            $table->timestamp('express_time')->comment('发货时间');
            $table->string('consignee',20)->comment('收货人');
            $table->string('express_phone',15)->comment('联系电话');
            $table->string('address',60)->comment('地址');
            $table->timestamp('order_time')->nullable()->comment('订单日期');
            $table->string('express_remark',50)->nullable()->comment('物流备注');
            $table->string('creator',20)->nullable()->comment('创建者');
            $table->unsignedInteger('creator_id')->default(0)->comment('创建者ID');
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
        Schema::dropIfExists('express_info');
    }
}
