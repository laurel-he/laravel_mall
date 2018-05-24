<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class AddHRRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $administrator = new Role();
        $administrator->name = 'human-resources';
        $administrator->display_name = '人事专员';
        $administrator->description = '给部门的人事专员';
        $administrator->save();
    }
}
