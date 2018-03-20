<?php
/**
 * 仓库里面的商品分类表 
 * 外键用 sku_sn 关联
 */
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEntrepotProductCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrepot_product_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cate_type',20)->nullable()->comment('商品类型 大分类');
            $table->string('cate_kind',20)->nullable()->comment('商品品种 小分类');
            $table->unsignedInteger('cate_type_id')->comment('商品类型 大分类 ID');
            $table->unsignedInteger('cate_kind_id')->comment('商品品种 小分类 ID');
            $table->unsignedTinyInteger('product_sale_type')->comment('销售类型 试用装 赠品 成品');
            $table->char('sku_sn', SKU_SN_LENGTH)->unique()->comment('商品编号');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entrepot_product_category');
    }
}
