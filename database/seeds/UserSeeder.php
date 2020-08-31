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
        factory(App\User::class, 100)->create()
            ->each(function ($user) {
                factory(App\Article::class, rand(1, 5))->create(
                    [
                        'user_id' => $user->id
                    ]
                );
            });
    }
}
