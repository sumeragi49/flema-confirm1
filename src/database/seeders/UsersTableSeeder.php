<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'test太郎',
            'email' => 'test1@example.com',
            'password' => \Hash::make('coachtech1001')
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'test次郎',
            'email' => 'test2@example.com',
            'password' => \Hash::make('coachtech1002')
        ];
        DB::table('users')->insert($param);
    }
}
