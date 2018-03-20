<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company_name',50)->comment('物流公司名称');
            $table->string('contact_name',20)->comment('物流公司联系人名字');
            $table->string('contact_tel',15)->comment('物流公司联系人电话');
            $table->string('remark')->comment('备注')->nullable();
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
        Schema::dropIfExists('express_companies');
    }
}
