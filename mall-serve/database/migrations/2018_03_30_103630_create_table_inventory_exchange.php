<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInventoryExchange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_exchange', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cus_name',20)->nullable()->comment('客户姓名');
            $table->char('sku_sn',50)->nullable()->comment('商品编号');
            $table->unsignedInteger('entrepot_id')->nullable()->comment('配送中心ID');
            $table->string('before_goods_name',20)->nullable()->comment('原商品名称');
            $table->unsignedInteger('before_goods_num')->nullable()->comment('原数量');
            $table->string('after_goods_name',20)->nullable()->comment('换后商品名称');
            $table->unsignedInteger('after_goods_num')->nullable()->comment('换后数量');
            $table->string('before_cate_type', 50)->nullable()->comment('原商品类型大分类');
            $table->string('before_cate_kind', 50)->nullable()->comment('原商品品类小分类');
            $table->unsignedInteger('before_cate_type_id')->nullable()->comment('原大分类id');
            $table->unsignedInteger('before_cate_kind_id')->nullable()->comment('原小分类id');
            $table->string('after_cate_type', 50)->nullable()->comment('后商品类型大分类');
            $table->string('after_cate_kind', 50)->nullable()->comment('后商品品类小分类');
            $table->unsignedInteger('after_cate_type_id')->nullable()->comment('后大分类id');
            $table->unsignedInteger('after_cate_kind_id')->nullable()->comment('后小分类id');
            $table->string('exchange_reason',60)->nullable()->comment('换货原因');
            $table->unsignedTinyInteger('in_inventory')->default(1)->comment('退货是否入库1是2否');
            $table->string('user_name',20)->nullable()->comment('操作人');
            $table->unsignedInteger('user_id')->nullable()->comment('操作人ID');
            $table->timestamp('exchange_at')->nullable()->comment('操作时间');
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
        Schema::dropIfExists('inventory_exchange');
    }
}
