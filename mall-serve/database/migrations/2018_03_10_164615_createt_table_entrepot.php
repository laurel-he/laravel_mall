<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatetTableEntrepot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //配送中心  仓库
        Schema::create('entrepot_basic', function(Blueprint $table){
            $table->increments('id');
            $table->string('name',20)->comment('名称');
            $table->string('contact', 20)->comment('联系人');
            $table->string('contact_phone', 20)->comment('联系人电话');
            $table->string('address', 100)->comment('地址');
            $table->string('comment', 100)->comment('备注');
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
        Schema::drop('entrepot_basic');
    }
}
