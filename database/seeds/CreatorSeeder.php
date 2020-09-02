<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
            'name' => 'Vanessa Ives',
            'email' => 'andre@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('creator1234'),
            'remember_token' => Str::random(10),
            'role' => 'creator'
        ]);

        $admin->save();

        $admin = new User([
            'name' => 'Mario Guttenberg',
            'email' => 'ze@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('creator1234'),
            'remember_token' => Str::random(10),
            'role' => 'creator'
        ]);

        $admin->save();

        $admin = new User([
            'name' => 'Camila Amaral',
            'email' => 'camila@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('creator1234'),
            'remember_token' => Str::random(10),
            'role' => 'creator'
        ]);

        $admin->save();
    }
}
