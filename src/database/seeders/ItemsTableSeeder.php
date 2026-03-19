<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
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
            'condition_id' => '1',
            'profile_id' => '1',
            'name' => '腕時計',
            'image' => 'Clock.jpg',
            'brand_name' => 'Rolax',
            'content' => 'スタイリッシュなデザインのメンズ腕時計',
            'price' => '15000'
        ];
        DB::table('items')->insert($param);

        $param =[
            'user_id' => '1',
            'condition_id' => '2',
            'profile_id' => '1',
            'name' => 'HDD',
            'image' => 'HDD.jpg',
            'brand_name' => '西芝',
            'content' => '高速で信頼性の高いハードディスク',
            'price' => '5000'
        ];
        DB::table('items')->insert($param);

        $param =[
            'user_id' => '1',
            'condition_id' => '3',
            'profile_id' => '1',
            'name' => '玉ねぎ3束',
            'image' => 'Onion.jpg',
            'brand_name' => 'なし',
            'content' => '新鮮な玉ねぎ3束のセット',
            'price' => '300'
        ];
        DB::table('items')->insert($param);

        $param =[
            'user_id' => '1',
            'condition_id' => '4',
            'profile_id' => '1',
            'name' => '革靴',
            'image' => 'LeatherShoes.jpg',
            'brand_name' => '',
            'content' => 'クラシックなデザインの革靴',
            'price' => '4000'
        ];
        DB::table('items')->insert($param);

        $param =[
            'user_id' => '1',
            'condition_id' => '1',
            'profile_id' => '1',
            'name' => 'ノートPC',
            'image' => 'NotePC.jpg',
            'brand_name' => '',
            'content' => '高性能なノートパソコン',
            'price' => '45000'
        ];
        DB::table('items')->insert($param);

        $param =[
            'user_id' => '2',
            'condition_id' => '1',
            'profile_id' => '2',
            'name' => 'マイク',
            'image' => 'MusicMic.jpg',
            'brand_name' => 'なし',
            'content' => '高音質のレコーディング用マイク',
            'price' => '8000'
        ];
        DB::table('items')->insert($param);

        $param =[
            'user_id' => '2',
            'condition_id' => '2',
            'profile_id' => '2',
            'name' => 'ショルダーバック',
            'image' => 'ShoulderBag.jpg',
            'brand_name' => '',
            'content' => 'おしゃれなショルダーバッグ',
            'price' => '3500'
        ];
        DB::table('items')->insert($param);

        $param =[
            'user_id' => '2',
            'condition_id' => '3',
            'profile_id' => '2',
            'name' => 'タンブラー',
            'image' => 'Tumbler.jpg',
            'brand_name' => 'なし',
            'content' => '使いやすいタンブラー',
            'price' => '500'
        ];
        DB::table('items')->insert($param);

        $param =[
            'user_id' => '2',
            'condition_id' => '4',
            'profile_id' => '2',
            'name' => 'コーヒーミル',
            'image' => 'CoffeeMill.jpg',
            'brand_name' => 'Starbacks',
            'content' => '手動のコーヒーミル',
            'price' => '4000'
        ];
        DB::table('items')->insert($param);

        $param =[
            'user_id' => '2',
            'condition_id' => '1',
            'profile_id' => '2',
            'name' => 'メイクセット',
            'image' => 'MakeupSet.jpg',
            'brand_name' => '',
            'content' => '便利なメイクアップセット',
            'price' => '2500'
        ];
        DB::table('items')->insert($param);
    }
}
