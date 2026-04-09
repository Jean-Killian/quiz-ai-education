<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Gère le classement des opérateurs du réseau (Leaderboard).
 */
class LeaderboardController extends Controller
{
    /**
     * Affiche le classement mondial basé sur les scores globaux.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::orderByDesc('global_score')
                    ->limit(50)
                    ->get();

        return view('leaderboard', compact('users'));
    }
}
