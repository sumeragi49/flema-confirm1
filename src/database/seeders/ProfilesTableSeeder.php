<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param =[
            'user_id' => '1',
            'image' => 'Clock.jpg',
            'name' => 'tes太郎',
            'post' => '123-4567',
            'address' => '東京都渋谷区千駄ヶ谷1-2-3',
            'building' => '千駄ヶ谷マンション101',
        ];
        DB::table('profiles')->insert($param);

        $param =[
            'user_id' => '2',
            'image' => 'CoffeeMill.jpg',
            'name' => 'tes次郎',
            'post' => '123-4567',
            'address' => '東京都渋谷区千駄ヶ谷1-2-3',
            'building' => '千駄ヶ谷マンション102',
        ];
        DB::table('profiles')->insert($param);
    }
}
