<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Compte de Test Principal (Opérateur)
        User::create([
            'name' => 'Opérateur Code_Zero',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'global_score' => 0,
        ]);

        // 2. Hackers de Légende pour le Leaderboard
        User::create([
            'name' => 'Morpheus',
            'email' => 'morpheus@nebuchadnezzar.io',
            'password' => Hash::make('password'),
            'global_score' => 2450,
        ]);

        User::create([
            'name' => 'Trinity',
            'email' => 'trinity@matrix.com',
            'password' => Hash::make('password'),
            'global_score' => 1820,
        ]);

        User::create([
            'name' => 'Neo',
            'email' => 'thomas.anderson@metacortex.com',
            'password' => Hash::make('password'),
            'global_score' => 3100,
        ]);

        User::create([
            'name' => 'Cypher',
            'email' => 'traitor@steak.com',
            'password' => Hash::make('password'),
            'global_score' => 450,
        ]);

        User::create([
            'name' => 'Niobe',
            'email' => 'captain@logis.io',
            'password' => Hash::make('password'),
            'global_score' => 1200,
        ]);
    }
}
