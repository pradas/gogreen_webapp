<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "Juanito";
        $user->username = "admin";
        $user->email = "admin@gogreen.com";
        $user->password = bcrypt("Password12");
        $user->role_id = '1';
        $user->save();

        /*
        $user = new User;
        $user->name = "";
        $user->username = "";
        $user->birth_date = \Carbon\Carbon::now();
        $user->email = "@gmail.com";
        $user->password = bcrypt("");
        $user->role_id = '2';
        $user->save();
        */

    }
}
