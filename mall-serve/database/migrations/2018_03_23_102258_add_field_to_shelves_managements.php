<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToShelvesManagements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shelves_managements', function (Blueprint $table) {
            if (!Schema::hasColumn('shelves_managements','shelves_status')){
                $table->unsignedSmallInteger('shelves_status')->nullable()->after('remark')->default(0)->comment('货架状态 0空，1满，2坏');
            }
            if (!Schema::hasColumn('shelves_managements','full_num')){
                $table->unsignedInteger('full_num')->nullable()->after('remark')->comment('满编数量');
            }
            if (!Schema::hasColumn('shelves_managements','deposit_num')){
                $table->unsignedInteger('deposit_num')->nullable()->after('remark')->default(0)->comment('已存放数量');
            }
            if (!Schema::hasColumn('shelves_managements','change_time')){
                $table->dateTime('change_time')->nullable()->after('remark')->comment('货架状态修改时间');
            }
            if (!Schema::hasColumn('shelves_managements','change_user')){
                $table->string('change_user',10)->nullable()->after('remark')->comment('货架状态修改人');
            }
            if (!Schema::hasColumn('shelves_managements','change_remark')){
                $table->string('change_remark',200)->nullable()->after('remark')->comment('货架状态修改备注');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
