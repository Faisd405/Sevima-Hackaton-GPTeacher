<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\UserProfiles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'User',
                'username' => 'itsUser',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user123'),
            ],
        ];

        foreach ($user as $key => $value) {
            $user = User::create([
                'name' => $value['name'],
                'username' => $value['username'],
                'email' => $value['email'],
                'password' => $value['password'],
            ]);

            UserProfiles::create([
                'user_id' => $user->id,
            ]);

        }
    }
}
