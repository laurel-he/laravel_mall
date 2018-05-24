<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartonManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carton_management', function (Blueprint $table) {
            $table->increments('id');
            $table->string('carton_name', 20)->nullable()->comment('纸箱类型');
            $table->string('carton_model',20)->nullable()->comment('纸箱型号');
            $table->string('carton_long',20)->nullable()->comment('纸箱长 mm');
            $table->string('carton_wide',20)->nullable()->comment('纸箱宽 mm');
            $table->string('carton_high',20)->nullable()->comment('纸箱高 mm');
            $table->unsignedInteger('carton_weight')->nullable()->comment('纸箱重量 g');
            $table->unsignedInteger('carton_number')->nullable()->comment('纸箱数量');
            $table->string('remark', 200)->nullable()->comment('备注');
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
        Schema::dropIfExists('carton_management');
    }
}
