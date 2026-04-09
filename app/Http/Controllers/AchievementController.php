<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Gère l'affichage des succès et des badges débloqués par l'utilisateur.
 */
class AchievementController extends Controller
{
    /**
     * Affiche la liste des badges disponibles et l'état de progression de l'utilisateur.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        $allBadges = Badge::all();
        $userBadges = $user->badges()->withPivot('created_at')->get();
        
        // Mapping des badges débloqués par ID pour une recherche rapide dans la vue
        $userBadgeMap = $userBadges->keyBy('id');
        
        $totalBadges = $allBadges->count();
        $unlockedCount = $userBadges->count();
        $percent = ($totalBadges > 0) ? round(($unlockedCount / $totalBadges) * 100) : 0;

        return view('achievements.index', compact('allBadges', 'userBadgeMap', 'unlockedCount', 'totalBadges', 'percent'));
    }
}
