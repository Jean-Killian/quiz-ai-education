<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl theme-primary leading-tight font-mono">
            > OPERATOR_REWARDS // SUCCESS_STREAM
        </h2>
    </x-slot>

    <div class="py-12 theme-bg-deep min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Global Progress Header (Steam Style) -->
            <div class="theme-bg-panel theme-border theme-glow border-2 rounded-lg p-8 mb-8 flex flex-col md:flex-row items-center gap-8">
                <div class="relative size-32 flex-shrink-0">
                    <svg class="size-full transform -rotate-90">
                        <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" class="text-slate-800" />
                        <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" class="theme-primary"
                            stroke-dasharray="{{ 2 * pi() * 58 }}"
                            stroke-dashoffset="{{ (2 * pi() * 58) * (1 - $percent / 100) }}"
                            stroke-linecap="round" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-3xl font-black text-white">{{ $percent }}%</span>
                        <span class="text-[8px] uppercase tracking-tighter text-slate-500">Completé</span>
                    </div>
                </div>

                <div class="flex-grow text-center md:text-left">
                    <h3 class="text-2xl font-black text-white uppercase tracking-widest mb-2">Hall_des_Succès</h3>
                    <p class="text-slate-400 font-mono text-sm mb-4">
                        Status de l'Opérateur : <span class="theme-primary font-bold">[{{ $unlockedCount }} / {{ $totalBadges }}] Médailles Collectées</span>
                    </p>
                    <div class="w-full h-3 bg-slate-800 rounded-full overflow-hidden border theme-border">
                        <div class="h-full theme-bg-deep theme-primary shadow-[0_0_10px_var(--primary-glow)] border-r-2 border-white/20 transition-all duration-1000" style="width: {{ $percent }}%; background-color: rgb(var(--primary))"></div>
                    </div>
                </div>
            </div>

            <!-- Badges Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($allBadges as $badge)
                    @php
                        $unlocked = isset($userBadgeMap[$badge->id]);
                        $date = $unlocked ? $userBadgeMap[$badge->id]->pivot->created_at : null;
                    @endphp
                    
                    <div class="relative group">
                        <div class="h-full p-6 border-2 transition-all duration-300 {{ $unlocked ? 'theme-bg-panel theme-border-primary theme-glow' : 'bg-slate-900 border-slate-800 opacity-60 grayscale' }}">
                            
                            <div class="flex items-start gap-4">
                                <!-- Badge Icon -->
                                <div class="size-16 flex-shrink-0 rounded bg-black/40 border {{ $unlocked ? 'theme-border-primary' : 'border-slate-700' }} flex items-center justify-center text-3xl shadow-inner overflow-hidden relative">
                                    @if($unlocked)
                                        <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent"></div>
                                        {!! $badge->icon !!}
                                    @else
                                        <svg class="size-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    @endif
                                </div>

                                <div class="flex-grow">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-black text-sm uppercase tracking-widest {{ $unlocked ? 'text-white' : 'text-slate-500' }}">
                                            {{ $badge->name }}
                                        </h4>
                                        @if($unlocked)
                                            <span class="text-[8px] bg-green-500/20 text-green-400 px-1.5 py-0.5 rounded border border-green-500/30 uppercase font-bold">Acquis</span>
                                        @endif
                                    </div>
                                    <p class="text-xs font-mono {{ $unlocked ? 'text-slate-300' : 'text-slate-600' }} mb-3">
                                        {{ $badge->description }}
                                    </p>
                                    
                                    @if($unlocked)
                                        <div class="text-[9px] text-slate-500 uppercase font-bold mt-auto border-t border-white/5 pt-2">
                                            Extraction : {{ $date->format('d M Y') }}
                                        </div>
                                    @else
                                        <div class="flex items-center gap-2 text-[9px] text-slate-700 uppercase font-black tracking-tighter mt-auto border-t border-white/5 pt-2">
                                            <span class="animate-pulse">> SYSTEM_LOCKED</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($unlocked)
                                <!-- Hover effect detail overlay -->
                                <div class="absolute inset-0 border-2 theme-border-primary opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
