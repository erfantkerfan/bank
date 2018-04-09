<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        //ToDo altering for live site
        // Seeding for not traping outside
        \App\User::create([
            'username' => 'erfan',
            'name' =>'عرفان قلی زاده',
            'acc_id' => '10000',
            'phone_number' => '09305551082',
            'email' => 'erfantkerfan@yahoo.com',
            'is_admin' => '1',
            'is_super_admin' => '1',
            'password' => bcrypt('12589'),
            'remember_token' => str_random(10),
        ]);

        //ToDo commenting after going live
        // Seeding User Table for testing app
        factory(\App\User::class,10)->create();


    }
}