<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserBasic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_basic', function (Blueprint $table) {
            $table->increments('id')->comment('员工ID');
            $table->string('account', 20)->unique()->comment('员工登陆账号');
            $table->string('realname', 20)->nullable()->comment('员工姓名');
            $table->string('head', 256)->default('/storage/head.jpg')->comment('员工头像');
            $table->string('password')->comment('登陆密码');
            $table->unsignedInteger('qq')->nullable()->comment('员工QQ号');
            $table->string('qq_nickname', 40)->nullable()->comment('员工QQ昵称');
//             $table->unsignedInteger('role_id')->comment('员工职位ID');
            $table->unsignedTinyInteger('sex')->default(0)->comment('0 未定义 1 男 2 女');
            $table->string('telephone',20)->nullable()->comment('员工固话');
            $table->string('mobilephone',20)->nullable()->comment('员工手机号');
            $table->string('id_card',20)->nullable()->comment('员工身份证号');
            $table->string('weixin',20)->nullable()->comment('员工微信号');
            $table->string('weixin_nickname',20)->nullable()->comment('员工微信昵称');
            $table->string('address',256)->nullable()->comment('员工住址');
            $table->string('location',256)->nullable()->comment('登陆地点');
            $table->ipAddress('ip')->nullable()->comment('登陆IP');
            $table->unsignedInteger('creator')->default(0)->comment('创建员工的id');
            $table->string('creator_name', 20)->nullable()->comment('创建员工');
            $table->dateTime('lg_time')->nullable()->comment('最后登陆时间');
            $table->dateTime('out_time')->nullable()->comment('最后退出时间');
            $table->unsignedInteger('department_id')->default(0)->nullable()->comment('员工所在部门ID');
            $table->unsignedInteger('group_id')->default(0)->nullable()->comment('员工所在团队ID');
            $table->enum('status',['1','-1'])->default(1)->comment('是否在职 1 在职 -1 离职');
            $table->rememberToken();
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
        Schema::dropIfExists('user_basic');
    }
}
