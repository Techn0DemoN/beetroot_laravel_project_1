<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [];

        for ($i = 0; $i < 10; $i++) {
                 $posts[] = [
                    'user_id' => rand(1, 2),
                    'title' => str_random(10),
                    'description' => str_random(50),
                    'content' => str_random(150),
                    'qr_code' => QrCode::generate(route('article_by_id', $i)),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ];
            }
            DB::table('posts')->insert($posts);
    }
}



