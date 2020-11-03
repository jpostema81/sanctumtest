<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;    

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        $data = array(
            array('name' => 'Jeroen Postema', 'email' => 'jeroen@script.nl', 'password' =>  Hash::make('password'))
        );

        DB::table('users')->insert($data);
    }
}
