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

        $user = new User;
        $user->name = "Manager";
        $user->username = "manager";
        $user->birth_date = \Carbon\Carbon::createFromDate(1995, 5, 21);
        $user->email = "manager@gogreen.com";
        $user->password = bcrypt("Password12");
        $user->role_id = '2';
        $user->save();

        $user = new User;
        $user->name = "Shoper";
        $user->username = "shoper";
        $user->birth_date = \Carbon\Carbon::createFromDate(1975, 4, 21);
        $user->email = "shoper@gogreen.com";
        $user->password = bcrypt("Password12");
        $user->role_id = '3';
        $user->save();

        $user = new User;
        $user->name = "User";
        $user->username = "user";
        $user->birth_date = \Carbon\Carbon::createFromDate(1985, 5, 21);
        $user->email = "user@gogreen.com";
        $user->password = bcrypt("Password12");
        $user->role_id = '4';
        $user->points = 1000;
        $user->save();

    }
}