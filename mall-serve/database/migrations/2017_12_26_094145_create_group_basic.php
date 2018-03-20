<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupBasic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_basic', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 20);
            $table->unsignedInteger('manager_id')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedTinyInteger('type')->default(0);
            $table->tinyInteger('status')
                ->default(1)
                ->comment('状态 1 启用 0 禁用');
            $table->string('remarks', 200)->nullable();
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
        Schema::dropIfExists('group_basic');
    }
}
