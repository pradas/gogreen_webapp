<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role;
        $role->name = "administrator";
        $role->save();

        $role = new Role;
        $role->name = "manager";
        $role->save();

        $role = new Role;
        $role->name = "shoper";
        $role->save();

        $role = new Role;
        $role->name = "user";
        $role->save();
    }
}
