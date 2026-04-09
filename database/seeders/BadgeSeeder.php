<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'name' => 'Zero Day Finder',
                'description' => 'Réussir un quiz de niveau Senior avec un score parfait.',
                'icon' => 'zap',
                'type' => 'skill',
            ],
            [
                'name' => 'SQL Destroyer',
                'description' => 'Détecter 5 failles liées aux injections SQL.',
                'icon' => 'database',
                'type' => 'skill',
            ],
            [
                'name' => 'Clean Code Purist',
                'description' => 'Identifier des failles de logique complexe.',
                'icon' => 'shield-check',
                'type' => 'skill',
            ],
            [
                'name' => 'Ghost in the Machine',
                'description' => 'Atteindre le grade de Hacker Elite (1000 XP).',
                'icon' => 'ghost',
                'type' => 'milestone',
            ],
            [
                'name' => 'Overclocker',
                'description' => 'Atteindre une série (streak) de 5 traques parfaites.',
                'icon' => 'flame',
                'type' => 'streak',
            ],
            [
                'name' => 'First Blood',
                'description' => 'Réussir sa toute première traque de bug.',
                'icon' => 'target',
                'type' => 'milestone',
            ],
            [
                'name' => 'Gladiateur du Réseau',
                'description' => 'Gagner son tout premier duel contre un autre opérateur.',
                'icon' => 'swords',
                'type' => 'duel',
            ],
            [
                'name' => 'Légende de l\'Arène',
                'description' => 'Remporter 5 duels au sommet.',
                'icon' => 'crown',
                'type' => 'duel',
            ],
            [
                'name' => 'Ghost Runner',
                'description' => 'Gagner un duel en moins de 30 secondes.',
                'icon' => 'timer',
                'type' => 'duel',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::updateOrCreate(['name' => $badge['name']], $badge);
        }
    }
}
