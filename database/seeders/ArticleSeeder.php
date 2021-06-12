<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            'user_id' => 1,
            'name' => 'Ебучий блятский пост всем похуй',
            'status' => 'Одобрено модерацией',
            'content' => '<img src ="/storage/content-img.jpg">',
            'save_count' => random_int(50,1000),
            'photo' => 'null'
        ]);
    }
}
