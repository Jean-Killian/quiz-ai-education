<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Gère l'historique des missions (logs de tentatives de quiz).
 */
class MissionController extends Controller
{
    /**
     * Affiche l'historique détaillé des missions accomplies par l'utilisateur.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $logs = Auth::user()->quizzes()
                    ->withPivot('score', 'created_at')
                    ->orderBy('pivot_created_at', 'desc')
                    ->get();

        return view('quizzes.logs', compact('logs'));
    }
}
