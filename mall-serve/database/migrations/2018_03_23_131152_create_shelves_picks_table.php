<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShelvesPicksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelves_picks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shelves_id')->unllable()->comment('货架ID');
            $table->unsignedInteger('cate_type_id')->unllable()->comment('商品类型ID');
            $table->string('cate_type',50)->unllable()->comment('商品类型');
            $table->unsignedInteger('cate_kind_id')->unllable()->comment('商品种类ID');
            $table->string('cate_kind',50)->unllable()->comment('商品种类');
            $table->string('goods_name',20)->unllable()->comment('商品名称');
            $table->unsignedInteger('goods_num')->unllable()->comment('商品数量');
            $table->string('sku_sn',20)->unllable()->comment('商品编号');
            $table->string('remarks',200)->unllable()->comment('备注');
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
        Schema::dropIfExists('shelves_picks');
    }
}
