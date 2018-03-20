<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAssignBack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assign_basic', function (Blueprint $table) {
           $table->string('cus_name',20)->nullable()->comment('客户姓名');
           $table->string('goods_name',20)->nullable()->comment('商品名称');
           $table->unsignedTinyInteger('goods_num')->default(0)->comment('商品数量');
           $table->string('unit_type',10)->nullable()->comment('商品单位');
           $table->char('sku_sn', SKU_SN_LENGTH)->nullable()->comment('商品编号');
           $table->string('cate_type',20)->nullable()->comment('大分类');
           $table->unsignedInteger('cate_type_id')->default(0)->comment('大分类ID');
           $table->string('cate_kind',20)->nullable()->comment('小分类');
           $table->unsignedInteger('cate_kind_id')->default(0)->comment('小分类');
           $table->unsignedTinyInteger('assign_type')->default(0)->comment('发货类型 正常、退货、换货');
           
           $table->string('deliver_name',20)->nullable()->comment('收件人姓名');
           $table->string('deliver_phone',20)->nullable()->comment('收件人 手机');
           $table->string('deliver_zip_code',20)->nullable()->comment('收件邮编');
           $table->string('deliver_address',100)->nullable()->comment('收件地址');
           
           $table->string('sale_name',10)->nullable()->comment('销售员姓名');
           $table->date('pass_check')->nullable()->comment('通过审核的时间');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assign_basic', function (Blueprint $table) {
            $table->dropColumn([
                'cus_name',
                'goods_name',
                'goods_num',
                'unit_type',
                'sku_sn',
                'cate_type',
                'cate_type_id',
                'cate_kind',
                'cate_kind_id',
                'assign_type',
                'deliver_name',
                'deliver_phone',
                'deliver_zip_code',
                'deliver_address',
                'sale_name',
                'pass_check'
            ]);
        });
    }
}
