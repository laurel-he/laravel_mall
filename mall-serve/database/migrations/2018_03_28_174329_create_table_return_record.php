<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReturnRecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_record', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entrepot_id');
            $table->unsignedTinyInteger('goods_status')->comment('完好　损坏');
            $table->string('goods_name', 20);
            $table->char('sku_sn', SKU_SN_LENGTH);
            $table->unsignedInteger('goods_num')->default(0);
            $table->string('express_sn', 50)->comment("快递号");
            $table->string('cus_name', 20)->nullable()->comment('客户');
            $table->string('cus_qq', 20)->nullable()->comment("客户qq");
            $table->string('cus_phone', 20)->nullable()->comment('客户 phone');
            $table->string('cus_weixin', 20)->nullable()->comment("客户 weixin");
            $table->string('reason', 100)->nullable()->comment('原因');
            $table->string('sale_name',20)->nullable()->comment("销售人员");
            $table->unsignedInteger('user_id')->comment('入库人ID');
            $table->string('user_name', 20)->nullable()->comment('入库人');
            $table->timestamp('return_at')->nullable()->comment('入库时间');
            $table->string('remark', 100)->nullable()->comment('备注');
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
        Schema::dropIfExists('return_record');
    }
}
