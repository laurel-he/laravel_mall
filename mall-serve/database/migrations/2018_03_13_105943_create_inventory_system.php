<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventorySystem extends Migration
{
    const SKU_SN_LENGTH = 50;
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_system', function(Blueprint $table){
           $table->increments('id');
           $table->unsignedInteger('entrepot_id')->comment('仓库ID');
           $table->char('sku_sn', SKU_SN_LENGTH)->comment('商品编号');
           $table->string('goods_name',50)->comment('商品名称');
           $table->unsignedInteger('entrepot_count')->default(0)->comment('仓库数量');
           $table->unsignedInteger('saleable_count')->default(0)->comment('可销售数量');
           $table->unsignedInteger('return_in')->default(0)->comment('退货入库 累加');
           $table->unsignedInteger('produce_in')->default(0)->comment('生产入库 累加');
           $table->unsignedInteger('exchange_in')->default(0)->comment('换货入库 累加');
           $table->unsignedInteger('transfer_in')->default(0)->comment('调拨入库 累加');
           
           $table->unsignedInteger('sale_lock')->default(0)->comment('销售锁定 即时');
           $table->unsignedInteger('assign_lock')->default(0)->comment('发货、配货锁定 即时');
           $table->unsignedInteger('exchange_lock')->default(0)->comment('换货锁定 即时');
           $table->unsignedInteger('send_ing')->default(0)->comment('发货在途 即时');
           $table->unsignedInteger('destroy_count')->default(0)->comment('损坏数量');
           
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
        Schema::dropIfExists('inventory_system');
    }
}
