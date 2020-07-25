<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            ['user_id' => '1', 'post_id' => 4, 'content' => 'comment one content'],
            ['user_id' => '1', 'post_id' => 5, 'content' => 'comment two content'],
            ['user_id' => '1', 'post_id' => 6, 'content' => 'comment three content'],
        ]);
    }
}