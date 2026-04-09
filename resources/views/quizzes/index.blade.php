<x-app-layout>
    <x-slot name="header">
        > ARCHIVES_DES_TRAQUES
    </x-slot>

    <div class="py-12 theme-bg-deep min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="theme-bg-panel overflow-hidden shadow-2xl rounded border theme-border theme-glow">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4 border-b theme-border pb-6">
                        <div>
                            <h3 class="text-xl font-bold text-white uppercase tracking-tighter flex items-center gap-2">
                                <span class="w-2 h-2 theme-bg-deep border theme-border-primary rounded-full animate-pulse"></span>
                                <span class="theme-primary">Missions_Disponibles</span>
                            </h3>
                            <p class="text-[10px] text-slate-500 uppercase tracking-widest mt-1">Sélectionnez une cible pour lancer l'analyse de code.</p>
                        </div>
                        <a href="{{ route('quizzes.generate') }}" class="theme-bg-deep border-2 theme-border-primary theme-primary font-black py-2 px-6 rounded text-xs uppercase tracking-widest transition-all shadow-[0_0_15px_var(--primary-glow)] flex items-center gap-2 group hover:theme-bg-panel">
                            <span class="group-hover:translate-x-1 transition-transform">+ Générer_Nouvelle_Cible()</span>
                        </a>
                    </div>
                    
                    @if(session('success'))
                        <div class="bg-black/30 border-2 theme-border-primary theme-primary px-4 py-3 rounded text-xs font-bold uppercase tracking-widest mb-8 flex items-center gap-3 animate-pulse">
                            <span class="flex-shrink-0">✓</span>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($quizzes->isEmpty())
                        <div class="py-20 text-center">
                            <div class="theme-primary opacity-20 text-5xl mb-4 text-center mx-auto uppercase">∅ No_Targets</div>
                            <p class="text-slate-500 font-mono text-xs uppercase tracking-[0.3em]">Aucune cible détectée dans le périmètre.</p>
                        </div>
                    @else
                        <div class="grid grid-cols-1 gap-4">
                            @foreach($quizzes as $quiz)
                                <div class="group theme-bg-deep border theme-border p-5 rounded hover:theme-border-primary transition-all flex flex-col md:flex-row justify-between items-center gap-4 relative overflow-hidden">
                                    <!-- Scanlines effect -->
                                    <div class="absolute inset-0 bg-[linear-gradient(rgba(18,16,16,0)_50%,rgba(0,0,0,0.1)_50%),linear-gradient(90deg,rgba(255,0,0,0.03),rgba(0,255,0,0.01),rgba(0,0,255,0.03))] bg-[length:100%_2px,3px_100%] pointer-events-none opacity-20"></div>
                                    
                                    <div class="relative z-10 flex items-center gap-4 w-full">
                                        <div class="size-10 theme-bg-panel rounded flex items-center justify-center border theme-border theme-primary group-hover:scale-110 transition-transform">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="font-bold text-white text-lg tracking-tight uppercase group-hover:theme-primary transition-colors">{{ $quiz->title }}</div>
                                            <div class="text-[10px] text-slate-500 uppercase tracking-widest mt-0.5">{{ $quiz->description }}</div>
                                        </div>
                                    </div>
                                    
                                    <div class="relative z-10 flex items-center gap-6 w-full md:w-auto justify-between md:justify-end border-t md:border-t-0 theme-border pt-4 md:pt-0">
                                        @if(isset($userQuizzes[$quiz->id]))
                                            <div class="flex flex-col items-end">
                                                <span class="text-[9px] text-slate-600 uppercase font-bold tracking-[0.2em]">Efficiency</span>
                                                <span class="text-xs font-mono font-bold theme-primary opacity-80">
                                                    {{ $userQuizzes[$quiz->id]->pivot->score }} / {{ $quiz->questions()->count() }}
                                                </span>
                                            </div>
                                        @endif
                                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="px-5 py-2 border theme-border text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] rounded-sm hover:theme-bg-panel hover:theme-border-primary hover:theme-primary transition-all">
                                            > Lancer_Hack
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
