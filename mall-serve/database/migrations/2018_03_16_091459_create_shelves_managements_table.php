<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShelvesManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelves_managements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shelves_name')->nullable()->comment('货架名称');
            $table->string('shelves_num')->nullable()->comment('货架编号');
            $table->unsignedInteger('distributor_id')->nullable()->comment('所属配送中心id');
            $table->string('distributor_name',20)->nullable()->comment('所属配送中心名称');
            $table->unsignedInteger('shelves_manager_id')->nullable()->comment('货架负责人id');
            $table->string('shelves_manager_name',10)->comment('货架负责人名字');
            $table->string('remark')->nullable()->comment('备注');
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
        Schema::dropIfExists('shelves_managements');
    }
}
