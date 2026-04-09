<x-app-layout>
    <div class="py-12 theme-bg-deep min-h-screen font-mono">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="theme-bg-panel border-2 theme-border theme-glow rounded-lg overflow-hidden mb-8">
                <div class="p-8 text-center border-b theme-border bg-black/20">
                    <h2 class="text-3xl font-black text-white uppercase tracking-[0.5em] mb-2">Résultat_du_Duel</h2>
                    <p class="text-slate-500 text-xs uppercase tracking-widest">ID_COMBAT: {{ substr($duel->id, 0, 13) }}... // STATUS: {{ $duel->status }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 items-center p-8 gap-8 relative">
                    <!-- VS Divider -->
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none opacity-10 hidden md:flex">
                        <span class="text-[12rem] font-black text-white italic">VS</span>
                    </div>

                    <!-- Challenger -->
                    <div class="text-center z-10">
                        <div class="relative inline-block mb-4">
                            <div class="size-24 rounded border-4 {{ $duel->winner_id === $duel->challenger_id ? 'theme-border-primary shadow-[0_0_25px_var(--primary-glow)]' : 'border-slate-800 opacity-50' }} overflow-hidden">
                                <img src="{{ $duel->challenger->avatar_url }}" alt="" class="w-full h-full object-cover">
                            </div>
                            @if($duel->winner_id === $duel->challenger_id)
                                <span class="absolute -top-3 -right-3 text-3xl">🏆</span>
                            @endif
                        </div>
                        <h3 class="text-xl font-black {{ $duel->winner_id === $duel->challenger_id ? 'theme-primary' : 'text-slate-500' }} uppercase">{{ $duel->challenger->name }}</h3>
                        <div class="mt-4 space-y-2">
                            <div class="text-3xl font-black text-white">{{ $duel->challenger_score }} pts</div>
                            <div class="text-xs text-slate-400">{{ number_format($duel->challenger_time_ms / 1000, 3) }}s</div>
                        </div>
                    </div>

                    <!-- Center Info -->
                    <div class="text-center z-10 flex flex-col items-center justify-center">
                        <div class="size-16 rounded-full theme-bg-deep border-4 theme-border flex items-center justify-center mb-6">
                            <span class="text-2xl font-black text-white">VS</span>
                        </div>
                        
                        @if($duel->status === 'completed')
                            <div class="bg-black/40 border theme-border p-4 rounded text-center">
                                <div class="text-[10px] text-slate-500 uppercase font-bold mb-1">Vainqueur_Détecté</div>
                                <div class="text-lg font-black theme-primary uppercase tracking-widest">{{ $duel->winner->name }}</div>
                                <div class="text-[9px] text-green-400 mt-2">+ 150 RÉPUTATION</div>
                            </div>
                        @else
                            <div class="bg-blue-900/20 border border-blue-500/50 p-4 rounded text-center animate-pulse">
                                <div class="text-[10px] text-blue-400 uppercase font-black tracking-widest">En_Attente_de_Réponse</div>
                                <div class="text-[8px] text-slate-500 mt-1 italic">Expiration dans 24h</div>
                            </div>
                        @endif
                    </div>

                    <!-- Defender -->
                    <div class="text-center z-10">
                        <div class="relative inline-block mb-4">
                            <div class="size-24 rounded border-4 {{ $duel->winner_id === $duel->defender_id ? 'theme-border-primary shadow-[0_0_25px_var(--primary-glow)]' : 'border-slate-800 opacity-50' }} overflow-hidden">
                                <img src="{{ $duel->defender->avatar_url }}" alt="" class="w-full h-full object-cover">
                            </div>
                            @if($duel->winner_id === $duel->defender_id)
                                <span class="absolute -top-3 -right-3 text-3xl">🏆</span>
                            @endif
                        </div>
                        <h3 class="text-xl font-black {{ $duel->winner_id === $duel->defender_id ? 'theme-primary' : 'text-slate-500' }} uppercase">{{ $duel->defender->name }}</h3>
                        <div class="mt-4 space-y-2">
                            <div class="text-3xl font-black text-white">
                                {{ $duel->defender_score !== null ? $duel->defender_score . ' pts' : '--' }}
                            </div>
                            <div class="text-xs text-slate-400">
                                {{ $duel->defender_time_ms !== null ? number_format($duel->defender_time_ms / 1000, 3) . 's' : '--' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-center gap-4">
                <a href="{{ route('leaderboard') }}" class="px-8 py-3 theme-bg-panel border theme-border text-white text-[10px] uppercase font-black hover:theme-bg-deep transition-all">
                    Retour au Leaderboard
                </a>
                <a href="{{ route('quizzes.index') }}" class="px-8 py-3 theme-bg-deep border-2 theme-border-primary theme-primary text-[10px] uppercase font-black hover:theme-bg-panel transition-all shadow-[0_0_15px_var(--primary-glow)]">
                    Continuer les Missions
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
