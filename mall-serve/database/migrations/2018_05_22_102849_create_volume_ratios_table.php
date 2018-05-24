<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolumeRatiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volume_ratios', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('frame_ratio')->default(90)->comment('商品长宽高与纸箱长宽高比例');
            $table->unsignedInteger('volume_ratio')->default(70)->comment('商品体积与纸箱体积比例');
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
        Schema::dropIfExists('volume_ratios');
    }
}
