<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = User::updateOrCreate(
            [
                'email' => 'admin@gmail.com'
            ],
            [
                'firstname' => 'Yash',
                'lastname' => 'Joshi',
                'email_verified_at' => now(),
                'password' => Hash::make('yash@123'),
                'profile' => '',
                'remember_token' => Str::random(10),
            ]
        );

        $editor = User::updateOrCreate(
            [
                'email' => 'editor@gmail.com'
            ],
            [
                'firstname' => 'Om',
                'lastname' => 'Joshi',
                'email_verified_at' => now(),
                'password' => Hash::make('yash@123'),
                'profile' => '',
                'remember_token' => Str::random(10),
            ]
        );

        $user = User::updateOrCreate(
            [
                'email' => 'user@gmail.com'
            ],
            [
                'firstname' => 'Divyesh',
                'lastname' => 'Joshi',
                'email_verified_at' => now(),
                'password' => Hash::make('yash@123'),
                'profile' => '',
                'remember_token' => Str::random(10),
            ]
        );


        $admin->assignRole('admin');
        $editor->assignRole('editor');
        $user->assignRole('user');
    }
}
