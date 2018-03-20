<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit_basic', function (Blueprint $table) {
        	//为了方便设置nullable
            $table->increments('id');
            $table->unsignedInteger('department_id')->nullable()->comment('部门ID');
            $table->unsignedInteger('group_id')->nullable()->comment('小组ID');
            $table->unsignedInteger('user_id')->nullable()->comment('员工ID');
            $table->unsignedInteger('charge_type')->comment('充值方式')->nullable();
            $table->date('charge_time')->nullable()->comment('充值时间');
            $table->string('department_name', 30)->nullable()->comment('部门名称');
            $table->string('group_name', 30)->nullable()->comment('小组名称');
            $table->string('realname', 30)->nullable()->comment('员工姓名');
            $table->string('remark')->nullable()->comment('备注');
            $table->decimal('money', 8, 2)->default('0.00');
            $table->unsignedInteger('creator_id')->nullable();
            $table->string('creator',30)->nullable();
            $table->string('charge_department', 30)->nullable();
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
        Schema::dropIfExists('deposit_basic');
    }
}
