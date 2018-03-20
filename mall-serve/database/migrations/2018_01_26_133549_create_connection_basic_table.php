<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConnectionBasicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('connection_basic',function (Blueprint $table){
            $table->increments('id')->comment('表id');
            $table->string('name')->comment('姓名');
            $table->string('phone',20)->nullable()->comment('电话');
            $table->text('content')->nullable()->comment('留言内容');
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
        Schema::dropIfExists('connection_basic');
    }
}
