<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProduceInInventory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //生产入库  父表
        Schema::create('produce_in_inventory', function(Blueprint $table){
            $table->increments('id');
            $table->char('entry_sn', DAN_LENGTH)->comment('入库单号自动生成');
            $table->string('user_name',30)->comment('入库人姓名');
            $table->unsignedInteger('user_id')->comment('入库人id');
            $table->unsignedInteger('entrepot_id')->comment('配送中心(仓库)id');
            $table->string('comment', 100)->nullable()->comment('备注');
            $table->string('entry_at')->nullable()->comment('入库时间');
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
        Schema::drop('produce_in_inventory');
    }
}
