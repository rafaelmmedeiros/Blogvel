<?php

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 0;

        while ($count < 90) {
            $userRand = rand(1, 14);
            $articleRand = rand(1, 20);
            factory(App\Comment::class, 1)->create(
                [
                    'user_id' => $userRand,
                    'article_id' => $articleRand
                ]
            );
            $count++;
        }
    }
}
