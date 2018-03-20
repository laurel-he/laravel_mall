<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateOrdersGoodsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create ( 'order_goods', function (Blueprint $table) {
			$table->increments ( 'id' );
			$table->unsignedInteger ( 'order_id' )->comment ( '订单ID' );
			$table->unsignedInteger ( 'goods_id' )->comment ( '商品ID' );
			$table->unsignedInteger ( 'sku_id' )->nullable()->comment ( 'SKU_ID' );
			$table->string ( 'goods_name' )->comment ( '商品名称' );
			$table->string ( 'sku_name' )->nullable()->comment ( 'SKU名称');
			$table->decimal('price',8,2)->default('0.00');
			$table->unsignedInteger ( 'goods_number' )->comment ( '商品数量' );
			$table->string ( 'remark' )->comment ( '备注' )->nullable();
            $table->enum('exchange_status', [0,1,2])->default(0)->comment('换货状态0正常1已被替换2替换后');
			$table->timestamps ();
			$table->softDeletes ();
		} );
	}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::dropIfExists('order_goods');
    }
}
