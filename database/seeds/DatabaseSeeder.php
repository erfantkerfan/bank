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
//        $toTruncate = ['users'];
//
//        foreach ($toTruncate as $table){
//            DB::table($table)->truncate();
//        }


        $this->call(UserTableSeeder::class);
    }
}
