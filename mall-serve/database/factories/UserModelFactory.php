<?php
use App\Models\Role;

/*
 * user_basic 表数据生成 
 * 普通员工
 * 
 */
 
 /** @var \Illuminate\Database\Eloquent\Factory $fatctory */

$factory->define(App\Models\User::class, function (Faker\Generator $faker){
   static $password = null;
   
   
   if (empty($password)) {
       $password = bcrypt('123456');
   }
   
   
   return [
       'account'=>  $faker->unique()->firstName,
       'realname'=> $faker->firstName,
       'password' => $password,
   ];
});


        