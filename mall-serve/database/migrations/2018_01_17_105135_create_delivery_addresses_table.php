<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('cus_id')->comment('客户ID');
            $table->string('name',20)->comment('收货人姓名');
            $table->string('phone',20)->comment('收货人手机号');
            $table->string('zip_code',20)->comment('收货邮编');
            $table->string('address')->comment('收货人地址');
            $table->unsignedInteger('default_address')->comment('1:默认地址');
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
        Schema::dropIfExists('delivery_addresses');
    }
}
