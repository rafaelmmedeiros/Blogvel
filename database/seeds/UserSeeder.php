<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()
            ->each(function ($user) {
                factory(App\Article::class, rand(1, 5))->create(
                    [
                        'user_id' => $user->id
                    ]
                )
                    ->each(function ($article) {
                        factory(App\Comment::class, rand(1, 5))->create(
                            [
                                'user_id' => rand(1, 10),
                                'article_id' => $article->id
                            ]);
                    });
            });
    }
}
