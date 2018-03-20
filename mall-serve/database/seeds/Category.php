<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Category extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('category_base')->insert([
				['label'=>'面膜',   'pid'=>0, 'level'=>1, 'type_id'=>0],
				['label'=>'爽肤水', 'pid'=>0, 'level'=>1, 'type_id'=>0],
				['label'=>'面霜',   'pid'=>0, 'level'=>1, 'type_id'=>0],
		]);
	}
}
