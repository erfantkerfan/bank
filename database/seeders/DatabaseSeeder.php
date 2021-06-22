<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */


    public function run()
    {
//        $toTruncate = ['users'];
//
//        foreach ($toTruncate as $table){
//            DB::table($table)->truncate();
//        }


        $this->call(UserTableSeeder::class);
    }
}
