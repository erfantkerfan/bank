<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        //ToDo altering for live site
        // Seeding for not traping outside
        \App\User::create([
            'username' => 'Ghoreishi',
            'f_name' =>'سید حسین',
            'l_name' =>'قریشی',
            'acc_id' => '102',
            'phone_number' => '09126226459',
            'email' => 'h_ghoreishi@sbu.ac.ir',
            'is_admin' => '1',
            'is_super_admin' => '1',
            'password' => bcrypt('12589'),
            'remember_token' => str_random(10),
        ]);

        //ToDo commenting after going live
        // Seeding User Table for testing app
//        factory(\App\User::class,10)->create();


    }
}