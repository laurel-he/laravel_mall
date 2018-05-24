<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumnToCustomerBasic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_basic', function (Blueprint $table) {
            $table->char('type',2)->after('age')->nullable()->comment('客户类型');
            $table->unsignedTinyInteger('source')->after('type')->nullable()->comment('客户来源');
            $table->unsignedInteger('area_province')->after('source')->nullable()->comment('省');
            $table->unsignedInteger('area_city')->after('area_province')->nullable()->comment('市/县');
            $table->char('id_card',20)->after('area_city')->nullable()->comment('身份证号');
            $table->string('cus_address',60)->after('id_card')->nullable()->comment('详细地址');
            $table->string('hobby',60)->after('cus_address')->nullable()->comment('客户爱好');
            $table->string('commonly_production',60)->after('hobby')->nullable()->comment('常用产品');
            $table->string('remark',60)->after('commonly_production')->nullable()->comment('备注');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_basic', function (Blueprint $table) {
            $table->dropColumn([
                'type', 
                'source',
                'area_province',
                'area_city',
                'id_card',
                'cus_address',
                'hobby',
                'commonly_production',
                'remark'
            ]);
        });
    }
}
