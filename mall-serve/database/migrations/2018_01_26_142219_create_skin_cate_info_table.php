<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkinCateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skin_cate_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('problem_one')->nullable()->comment('问题一答案');
            $table->string('problem_two')->nullable()->comment('问题二答案');
            $table->string('problem_three')->nullable()->comment('问题三答案');
            $table->string('problem_four')->nullable()->comment('问题四答案');
            $table->string('problem_five')->nullable()->comment('问题五答案');
            $table->string('contact_phone')->nullable()->comment('提交人联系方式');
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
        Schema::dropIfExists('skin_cate_info');
    }
}
