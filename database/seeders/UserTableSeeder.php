<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        // Seeding for not traping outside
        \App\User::create([
            'username' => 'test',
            'f_name' =>'عرفان',
            'l_name' =>'قلی زاده',
            'acc_id' => '1000',
            'phone_number' => '09301234567',
            'email' => 'test@sbu.ac.ir',
            'is_admin' => '1',
            'is_super_admin' => '1',
            'password' => bcrypt('123456'),
            'remember_token' => str_random(10),
        ]);

//        factory(\App\User::class,10)->create();

    }
}