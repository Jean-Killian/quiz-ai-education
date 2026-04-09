<?php

namespace App\Http\Controllers;

use App\Models\Duel;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DuelController extends Controller
{
    /**
     * Show form to initiate a duel against a specific user.
     */
    public function create(User $user)
    {
        $quizzes = Quiz::all();
        return view('duels.create', compact('user', 'quizzes'));
    }

    /**
     * Store the initial duel request (Challenger launches the attack).
     */
    public function store(Request $request)
    {
        $request->validate([
            'defender_id' => 'required|exists:users,id',
            'quiz_id' => 'required|exists:quizzes,id',
        ]);

        $duel = Duel::create([
            'challenger_id' => Auth::id(),
            'defender_id' => $request->defender_id,
            'quiz_id' => $request->quiz_id,
            'status' => 'pending',
            'expires_at' => Carbon::now()->addHours(24),
        ]);

        return redirect()->route('duels.play', $duel->id)
            ->with('info', 'Défi initialisé. Préparez votre attaque !');
    }

    /**
     * Duel Arena: The place where both play.
     */
    public function play(Duel $duel)
    {
        // If expired
        if ($duel->expires_at->isPast() && $duel->status !== 'completed') {
            $duel->update(['status' => 'expired']);
            return redirect()->route('leaderboard')->with('error', 'Ce défi a expiré.');
        }

        $quiz = $duel->quiz;
        
        // Determine role
        if (Auth::id() === $duel->challenger_id && $duel->challenger_score === null) {
            return view('duels.play', compact('duel', 'quiz'));
        }

        if (Auth::id() === $duel->defender_id && $duel->defender_score === null) {
            $duel->update(['status' => 'open']);
            return view('duels.play', compact('duel', 'quiz'));
        }

        return redirect()->route('duels.result', $duel->id);
    }

    /**
     * Submit results for a duel attempt.
     */
    public function submit(Request $request, Duel $duel)
    {
        $score = $request->input('score');
        $timeMs = $request->input('time_ms');

        if (Auth::id() === $duel->challenger_id) {
            $duel->update([
                'challenger_score' => $score,
                'challenger_time_ms' => $timeMs,
            ]);
        } elseif (Auth::id() === $duel->defender_id) {
            $duel->update([
                'defender_score' => $score,
                'defender_time_ms' => $timeMs,
                'status' => 'completed',
            ]);
            
            $this->resolveWinner($duel);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Resolve the winner after both have played.
     */
    private function resolveWinner(Duel $duel)
    {
        $winnerId = null;

        if ($duel->challenger_score > $duel->defender_score) {
            $winnerId = $duel->challenger_id;
        } elseif ($duel->defender_score > $duel->challenger_score) {
            $winnerId = $duel->defender_id;
        } else {
            // Equal scores, compare time
            if ($duel->challenger_time_ms < $duel->defender_time_ms) {
                $winnerId = $duel->challenger_id;
            } else {
                $winnerId = $duel->defender_id;
            }
        }

        $duel->update(['winner_id' => $winnerId]);

        // Reward logic
        if ($winnerId) {
            $winner = User::find($winnerId);
            $winner->increment('global_score', 150); // Winner bonus
            
            $loserId = ($winnerId == $duel->challenger_id) ? $duel->defender_id : $duel->challenger_id;
            $loser = User::find($loserId);
            $loser->decrement('global_score', min($loser->global_score, 50)); // Loser penalty

            // Check for Duel Badges
            $this->checkDuelBadges($winner, $duel);
        }
    }

    private function checkDuelBadges(User $user, Duel $duel)
    {
        $unlocked = [];
        $winCount = $user->wonDuels()->count();

        // 1st Win: Gladiateur du Réseau
        if ($winCount >= 1) {
            $badge = \App\Models\Badge::where('name', 'Gladiateur du Réseau')->first();
            if ($badge) $user->badges()->syncWithoutDetaching([$badge->id]);
        }

        // 5 Wins: Légende de l'Arène
        if ($winCount >= 5) {
            $badge = \App\Models\Badge::where('name', 'Légende de l\'Arène')->first();
            if ($badge) $user->badges()->syncWithoutDetaching([$badge->id]);
        }

        // Fast Win: Ghost Runner (under 30s)
        $timeMs = ($user->id === $duel->challenger_id) ? $duel->challenger_time_ms : $duel->defender_time_ms;
        if ($timeMs < 30000) {
            $badge = \App\Models\Badge::where('name', 'Ghost Runner')->first();
            if ($badge) $user->badges()->syncWithoutDetaching([$badge->id]);
        }
    }

    public function result(Duel $duel)
    {
        return view('duels.result', compact('duel'));
    }
}
