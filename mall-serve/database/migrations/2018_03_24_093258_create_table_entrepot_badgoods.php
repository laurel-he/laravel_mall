<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEntrepotBadgoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepot_badgoods', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('entrepot_id')->comment('仓库ID');
            $table->char('sku_sn', SKU_SN_LENGTH)->comment('商品编号');
            $table->string('cate_type', 20)->comment('商品类型 大分类');
            $table->string('cate_kind', 20)->comment('商品品类 小分类');
            $table->unsignedInteger('cate_type_id')->comment('大分类id');
            $table->unsignedInteger('cate_kind_id')->comment('小分类id');
            $table->unsignedTinyInteger('product_sale_type')->comment('试用装 赠品 成品');
            $table->unsignedMediumInteger('num')->default(0)->comment('数量');
            $table->unsignedInteger('user_id')->comment('入库人id');
            $table->string('user_name', 20)->nullable()->comment('入库人姓名');
            $table->timestamp('reg_at')->nullable()->comment('入库时间');
            $table->string('remark',100)->nullable()->comment('备注');
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
        Schema::dropIfExists('entrepot_badgoods');
    }
}
