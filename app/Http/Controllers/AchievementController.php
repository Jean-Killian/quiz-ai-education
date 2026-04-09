<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $allBadges = Badge::all();
        $userBadges = $user->badges()->withPivot('created_at')->get();
        
        // Map user badges by ID for easy lookup
        $userBadgeMap = $userBadges->keyBy('id');
        
        $totalBadges = $allBadges->count();
        $unlockedCount = $userBadges->count();
        $percent = ($totalBadges > 0) ? round(($unlockedCount / $totalBadges) * 100) : 0;

        return view('achievements.index', compact('allBadges', 'userBadgeMap', 'unlockedCount', 'totalBadges', 'percent'));
    }
}
