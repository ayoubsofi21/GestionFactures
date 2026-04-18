<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Directeur',
            'email' => 'ayoubsofi@gmail.com',
            'password' => Hash::make('12344321'), // or just 'motdepasse' if you're using 'hashed' cast in User model
            'user_type' => 'Directeur',
        ]);
    }
}