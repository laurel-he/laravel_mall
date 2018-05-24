<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_receives', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('express_id')->nullable()->comment('物流公司ID');
            $table->string('express_name',20)->nullable()->comment('物流公司名称');
            $table->string('assign_sn',20)->nullable()->comment('发货单号');
            $table->string('express_sn',20)->nullable()->comment('快递单号');
            $table->timestamp('assign_check_time',20)->nullable()->comment('发货核对时间');
            $table->unsignedInteger('check_user_id')->nullable()->comment('核对人ID');
            $table->string('check_user_name',20)->nullable()->comment('核对人');
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
        Schema::dropIfExists('express_receives');
    }
}
