<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-green-400 leading-tight font-mono">
            > HALL_OF_FAME // ACCESS_GRANTED
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700">
                <div class="p-6">
                    <div class="mb-8 border-b border-gray-700 pb-4">
                        <h3 class="text-xl font-mono text-green-500 font-bold uppercase tracking-[0.2em]">[ TOP_OPERATORS_BY_REPUTATION ]</h3>
                        <p class="text-gray-500 font-mono text-xs mt-1 uppercase tracking-widest">Listing des 50 meilleurs traqueurs du réseau.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left font-mono text-sm border-separate border-spacing-y-2">
                            <thead>
                                <tr class="text-gray-500 uppercase tracking-widest text-[10px]">
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
                                        $rowBg = $isCurrentUser ? 'bg-green-900/20 border-green-500/50' : 'bg-slate-900/50 border-slate-700';
                                        $textColor = $isCurrentUser ? 'text-green-400 font-bold' : 'text-slate-300';
                                    @endphp
                                    <tr class="border rounded transition-all duration-300 transform hover:scale-[1.01] {{ $rowBg }} {{ $isCurrentUser ? 'shadow-[0_0_15px_rgba(34,197,94,0.1)]' : '' }}">
                                        <td class="px-4 py-3 font-black text-green-600">
                                            @if($rank == 1) <span class="text-xl">🏆</span> @endif
                                            @if($rank == 2) <span class="text-xl text-slate-400">🥈</span> @endif
                                            @if($rank == 3) <span class="text-xl text-amber-700">🥉</span> @endif
                                            [{{ str_pad($rank, 2, '0', STR_PAD_LEFT) }}]
                                        </td>
                                        <td class="px-4 py-3 {{ $textColor }}">
                                            {{ $user->name }}
                                            @if($isCurrentUser)
                                                <span class="ml-2 text-[10px] bg-green-500 text-black px-1 py-0.5 rounded font-black uppercase tracking-tighter">You</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-right font-black text-green-500">
                                            {{ number_format($user->global_score) }} XP
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @if($user->global_score > 5000)
                                                <span class="text-[9px] border border-red-500 text-red-500 px-2 py-0.5 rounded uppercase font-black tracking-widest">Elite_Hunter</span>
                                            @elseif($user->global_score > 1000)
                                                <span class="text-[9px] border border-green-500 text-green-500 px-2 py-0.5 rounded uppercase font-black tracking-widest">Active_Agent</span>
                                            @else
                                                <span class="text-[9px] border border-gray-600 text-gray-600 px-2 py-0.5 rounded uppercase font-black tracking-widest">Rookie_Op</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 border-t border-gray-700 pt-6 flex justify-between items-center text-[10px] font-mono text-gray-600 uppercase tracking-widest">
                        <span>Terminal_v2.0 // Secured_Connection</span>
                        <span>Total_Operators: {{ count($users) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
