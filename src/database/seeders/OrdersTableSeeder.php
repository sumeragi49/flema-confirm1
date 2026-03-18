<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => '2',
            'item_id' => '1',
            'payment_method' => '1',
            'post' => '123-4567',
            'address' => '東京都渋谷区千駄ヶ谷1-2-3',
            'building' => '千駄ヶ谷マンション102',
        ];
        DB::table('orders')->insert($param);

        $param = [
            'user_id' => '1',
            'item_id' => '2',
            'payment_method' =>'1',
            'post' => '123-4567',
            'address' => '東京都渋谷区千駄ヶ谷1-2-3',
            'building' => '千駄ヶ谷マンション101'
        ];
        DB::table('orders')->insert($param);
    }
}
