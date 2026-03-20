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
            'price' => '15000',
            'stripe_url' => 'https://buy.stripe.com/test_eVq4gyacY0mT5fGfWLc3m09'
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
            'price' => '5000',
            'stripe_url' => 'https://buy.stripe.com/test_28EfZgdpad9FdMcaCrc3m08'
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
            'price' => '300',
            'stripe_url' => 'https://buy.stripe.com/test_fZu9ASbh25Hd9vWfWLc3m07'
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
            'price' => '4000',
            'stripe_url' => 'https://buy.stripe.com/test_9B600icl61qXdMch0Pc3m06'
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
            'price' => '45000',
            'stripe_url' => 'https://buy.stripe.com/test_4gMfZgfxi4D9bE425Vc3m03'
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
            'price' => '8000',
            'stripe_url' => 'https://buy.stripe.com/test_eVq00ifxi9XteQg6mbc3m05'
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
            'price' => '3500',
            'stripe_url' => 'https://buy.stripe.com/test_fZubJ098UfhNeQg25Vc3m00'
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
            'price' => '500',
            'stripe_url' => 'https://buy.stripe.com/test_fZu6oG1Gs6LheQgh0Pc3m04'
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
            'price' => '4000',
            'stripe_url' => 'https://buy.stripe.com/test_28E3cu5WI7Pl8rS9ync3m02'
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
            'price' => '2500',
            'stripe_url' => 'https://buy.stripe.com/test_dRmaEW0Co6LhfUkeSHc3m01'
        ];
        DB::table('items')->insert($param);
    }
}
