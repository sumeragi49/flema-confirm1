<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
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
            'profile_id' => '2',
            'item_id' => '1',
            'content' => 'もう少し安くなりませんか？'
        ];
        DB::table('comments')->insert($param);

        $param = [
            'user_id' => '2',
            'profile_id' => '2',
            'item_id' => '2',
            'content' => 'もう少し安くなりませんか？'
        ];
        DB::table('comments')->insert($param);
    }
}
