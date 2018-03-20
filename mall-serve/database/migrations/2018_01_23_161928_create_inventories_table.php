<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_basic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('goods_type',10)->nullable()->comment('商品类型');
            $table->string('goods_name', 20)->nullable()->comment('商品名称');
            $table->unsignedInteger('goods_sum')->default(0)->comment('商品数量');
            $table->string('goods_version',20)->nullable()->comment('商品型号');
            $table->string('goods_batch',20)->nullable()->comment('商品批次');
            $table->unsignedTinyInteger('type')->default(1)->comment('1 入库 2 出库');
            $table->date('create_time')->nullable()->comment('设置的时间');
            $table->unsignedInteger('user_id')->nullable()->comment('入库出库员工id');
            $table->string('user',20)->nullable()->comment('入库出库员工名称');
            $table->string('order_sn', 30)->nullable()->comment('出库时的订单号');
            
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
        Schema::dropIfExists('inventory_basic');
    }
}
