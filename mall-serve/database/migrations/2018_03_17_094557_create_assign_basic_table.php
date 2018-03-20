<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignBasicTable extends Migration
{
    /**
     * Run the migrations. 配货单（发货单）
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_basic', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entrepot_id')->comment('仓库ID');
            $table->char('assign_sn', DAN_LENGTH)->comment('配货单号');
            $table->unsignedInteger('order_id')->comment('订单ID');
            $table->unsignedInteger('user_id')->comment('发货人ID')->nullable();
            $table->string('user_name',20)->comment('发货人姓名')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->comment('配货单 状态');
            $table->unsignedInteger('express_id')->default(0)->comment('快递公司的id');
            $table->string('express_name', 20)->nullable()->comment('快递公司的名称');
            $table->unsignedTinyInteger('assign_print_status')->default(0)->comment('配货单 打印状态 0未打印 1已打印');
            $table->unsignedTinyInteger('express_print_status')->default(0)->comment('快递单打印状态 同上');
            $table->unsignedTinyInteger('set_express')->nullable()->comment('是否指定快递');
            $table->timestamp('express_print_at')->nullable()->comment('快递打印时间');
            $table->timestamp('assign_print_at')->nullable()->comment('配货单打印时间');
            $table->string('weight',3)->nullable()->comment('重量 单位KG');
            $table->decimal('assign_fee')->nullable()->comment('配送费 0.00');
            $table->decimal('express_fee')->nullable()->comment('快递费 0.00');
            $table->timestamp('out_entrepot_at')->nullable()->comment('发货时间 出仓库时间');
            $table->timestamp('sign_at')->nullable()->comment('签收时间');
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
        Schema::dropIfExists('assign_basic');
    }
}
