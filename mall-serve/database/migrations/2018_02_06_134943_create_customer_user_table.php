<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('customer_user', function (Blueprint $table) {
    		$table->increments('id');
    		$table->unsignedInteger('user_id')->comment('员工ID');
    		$table->unsignedInteger('cus_id')->comment('客户ID');
    		$table->unsignedTinyInteger('type')->comment('客户来源类型');
    		//$table->xxx()->after('cus_id')->comment();
    		$table->unsignedInteger('group_id')->comment('小组ID 为方便查询功能和统计');
    		$table->unsignedInteger('department_id')->comment('部门ID 为方便查询功能和统计');
    		$table->string('group_name', 20)->nullable()->comment('小组名称');
    		$table->string('department_name', 20)->nullable()->comment('部门名称');
    		$table->string('user_name', 20)->nullable()->comment('员工姓名');
    		
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
    	Schema::dropIfExists('customer_user');
    }
}
