<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('联系人姓名');
            $table->string('relationship_id')->comment('与本人关系ID');
            $table->string('user_id')->comment('员工ID');
            $table->string('phone')->comment('联系人电话');
            $table->string('qq')->comment('联系人QQ');
            $table->string('weixin')->comment('联系人微信');
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
        Schema::dropIfExists('contacts');
    }
}
