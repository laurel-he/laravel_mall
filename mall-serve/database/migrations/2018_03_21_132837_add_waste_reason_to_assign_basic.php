<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWasteReasonToAssignBasic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assign_basic', function (Blueprint $table) {
            if (!Schema::hasColumn('assign_basic','waste_reason')){
                $table->string('waste_reason',300)->nullable()->comment('废单原因');
            }
            if (!Schema::hasColumn('assign_basic','contact_content')){
                $table->string('contact_content',300)->nullable()->comment('沟通明细');
            }
            if (!Schema::hasColumn('assign_basic','communicate_time')){
                $table->dateTime('communicate_time')->nullable()->comment('沟通时间');
            }
            if (!Schema::hasColumn('assign_basic','send_time')){
                $table->dateTime('send_time')->nullable()->comment('发货时间');
            }
            if (!Schema::hasColumn('assign_basic','edit_time')){
                $table->dateTime('edit_time')->nullable()->comment('修改时间');
            }
            if (!Schema::hasColumn('assign_basic','waste_time')){
                $table->dateTime('waste_time')->nullable()->comment('废单时间');
            }
            if (!Schema::hasColumn('assign_basic','edit_address_time')){
                $table->dateTime('edit_address_time')->nullable()->comment('修改地址时间');
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
