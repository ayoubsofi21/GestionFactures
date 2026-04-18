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
            'user_type' => 'Directeur',
        ]);
    }
}