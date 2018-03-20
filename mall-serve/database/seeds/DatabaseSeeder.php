<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(RoleTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(UserTableSeeder2::class);
         $this->call(GoodsTypeTableSeeder::class);
         $this->call(Category::class);
    }
}
