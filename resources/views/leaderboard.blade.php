<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-green-400 leading-tight font-mono">
            > HALL_OF_FAME // ACCESS_GRANTED
        </h2>
    </x-slot>

    <div class="py-12 theme-bg-deep min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="theme-bg-panel overflow-hidden shadow-2xl sm:rounded-lg border theme-border theme-glow">
                <div class="p-6">
                    <div class="mb-8 border-b theme-border pb-4">
                        <h3 class="text-xl font-mono theme-primary font-bold uppercase tracking-[0.2em]">[ TOP_OPERATORS_BY_REPUTATION ]</h3>
                        <p class="text-slate-500 font-mono text-xs mt-1 uppercase tracking-widest">Listing des 50 meilleurs traqueurs du réseau.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left font-mono text-sm border-separate border-spacing-y-2">
                            <thead>
                                <tr class="text-slate-500 uppercase tracking-widest text-[10px]">
                                    <th class="px-4 py-2 font-black">Rank</th>
                                    <th class="px-4 py-2 font-black">Operator_Alias</th>
                                    <th class="px-4 py-2 font-black text-right">Reputation_Points</th>
                                    <th class="px-4 py-2 font-black text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                    @php
                                        $isCurrentUser = ($user->id === auth()->id());
                                        $rank = $index + 1;
                                        $rowBg = $isCurrentUser ? 'bg-black/40 border-2 theme-border-primary' : 'theme-bg-deep border theme-border';
                                        $textColor = $isCurrentUser ? 'theme-primary font-bold' : 'text-slate-300';
                                    @endphp
                                    <tr class="rounded transition-all duration-300 transform hover:scale-[1.01] {{ $rowBg }} {{ $isCurrentUser ? 'shadow-[0_0_15px_var(--primary-glow)]' : '' }}">
                                        <td class="px-4 py-3 font-black {{ $isCurrentUser ? 'theme-primary' : 'text-slate-500' }}">
                                            @if($rank == 1) <span class="text-xl">🏆</span> @endif
                                            @if($rank == 2) <span class="text-xl text-slate-400">🥈</span> @endif
                                            @if($rank == 3) <span class="text-xl text-amber-700">🥉</span> @endif
                                            [{{ str_pad($rank, 2, '0', STR_PAD_LEFT) }}]
                                        </td>
                                        <td class="px-4 py-3 {{ $textColor }} flex items-center gap-3">
                                            <div class="size-6 rounded-full border theme-border overflow-hidden">
                                                <img src="{{ $user->avatar_url }}" alt="" class="w-full h-full object-cover">
                                            </div>
                                            {{ $user->name }}
                                            @if($isCurrentUser)
                                                <span class="text-[10px] theme-bg-panel theme-primary border theme-border-primary px-1 py-0.5 rounded font-black uppercase tracking-tighter">You</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-right font-black theme-primary">
                                            {{ number_format($user->global_score) }} XP
                                        </td>
                                        <td class="px-4 py-3 text-center flex items-center justify-center gap-2">
                                            @if($user->global_score > 5000)
                                                <span class="text-[9px] border border-red-500 text-red-500 px-2 py-0.5 rounded uppercase font-black tracking-widest">Elite_Hunter</span>
                                            @elseif($user->global_score > 1000)
                                                <span class="text-[9px] border theme-border-primary theme-primary px-2 py-0.5 rounded uppercase font-black tracking-widest">Active_Agent</span>
                                            @else
                                                <span class="text-[9px] border border-slate-600 text-slate-600 px-2 py-0.5 rounded uppercase font-black tracking-widest">Rookie_Op</span>
                                            @endif

                                            @if(!$isCurrentUser)
                                                <a href="{{ route('duels.create', $user->id) }}" class="ml-2 p-1.5 theme-bg-deep theme-primary border theme-border-primary rounded hover:theme-bg-panel transition-all" title="Challenge this Operator">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 border-t theme-border pt-6 flex justify-between items-center text-[10px] font-mono text-slate-600 uppercase tracking-widest">
                        <span>Terminal_v2.5 // Theme_Enabled</span>
                        <span>Total_Operators: {{ count($users) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
