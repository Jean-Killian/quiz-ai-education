<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    public function index()
    {
        $logs = Auth::user()->quizzes()
                    ->withPivot('score', 'created_at')
                    ->orderBy('pivot_created_at', 'desc')
                    ->get();

        return view('quizzes.logs', compact('logs'));
    }
}
