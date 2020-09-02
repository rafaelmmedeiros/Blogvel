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

        while ($count < 20) {
            $randon = rand(2, 4);
            factory(App\Article::class, 1)->create(
                [
                    'user_id' => $randon
                ]
            );
            $count++;
        }
    }
}
