<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 0;

        while ($count < 30) {
            $randon = rand(1, 3);
            factory(App\Article::class, 1)->create(
                [
                    'user_id' => $randon
                ]
            );
            $count++;
        }
    }
}
