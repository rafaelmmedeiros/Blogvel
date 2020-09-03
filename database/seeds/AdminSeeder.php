<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
            'name' => 'Rafael Medeiros',
            'email' => 'rafael@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1234'),
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);

        $admin->save();

        $admin = new User([
            'name' => 'Vanessa Ives',
            'email' => 'vanessa@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1234'),
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);

        $admin->save();

        $admin = new User([
            'name' => 'Mario Guttenberg',
            'email' => 'mario@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1234'),
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);

        $admin->save();

        $admin = new User([
            'name' => 'Camila Amaral',
            'email' => 'camila@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin1234'),
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);

        $admin->save();
    }
}
