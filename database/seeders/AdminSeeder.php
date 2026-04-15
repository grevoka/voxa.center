<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@voxa.center'],
            [
                'name' => 'Admin Voxa',
                'password' => Hash::make('admin2024'),
                'role' => 'admin',
            ]
        );
    }
}
