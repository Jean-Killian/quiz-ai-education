<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl theme-primary leading-tight font-mono">
            > MISSION_LOGS // ACCESSING_RECORDS
        </h2>
    </x-slot>

    <div class="py-12 theme-bg-deep min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="theme-bg-panel theme-border border-2 rounded-lg overflow-hidden theme-glow">
                <div class="p-6 border-b theme-border bg-black/20 flex justify-between items-center">
                    <div>
                        <h3 class="text-white font-black uppercase tracking-widest text-lg font-mono">Operation_History</h3>
                        <p class="text-[10px] text-slate-500 uppercase tracking-widest mt-1">Total_Missions_Analyzed: {{ $logs->count() }}</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left font-mono">
                        <thead>
                            <tr class="bg-black/40 text-slate-500 text-[10px] uppercase tracking-[0.2em]">
                                <th class="px-6 py-4">Timestamp</th>
                                <th class="px-6 py-4">Traque_Target</th>
                                <th class="px-6 py-4">Difficulty</th>
                                <th class="px-6 py-4 text-center">Efficiency</th>
                                <th class="px-6 py-4 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y theme-border">
                            @forelse($logs as $log)
                            <tr class="hover:bg-white/5 transition-colors group">
                                <td class="px-6 py-4 text-xs text-slate-400">
                                    {{ $log->pivot->created_at->format('Y.m.d H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-white font-bold text-xs uppercase">{{ $log->title }}</span>
                                        <span class="text-[9px] text-slate-600">ID: {{ substr($log->id, 0, 8) }}...</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] px-2 py-0.5 rounded border 
                                        @if($log->difficulty === 'Senior') border-red-500/50 text-red-400 bg-red-500/10
                                        @elseif($log->difficulty === 'Medior') border-yellow-500/50 text-yellow-400 bg-yellow-500/10
                                        @else border-blue-500/50 text-blue-400 bg-blue-500/10 @endif uppercase font-black">
                                        {{ $log->difficulty }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @php
                                        $total = $log->questions()->count();
                                        $score = $log->pivot->score;
                                        $percent = ($total > 0) ? ($score / $total) * 100 : 0;
                                    @endphp
                                    <div class="flex flex-col items-center">
                                        <div class="w-20 h-1.5 bg-slate-800 rounded-full overflow-hidden mb-1">
                                            <div class="h-full @if($percent == 100) bg-green-500 @elseif($percent > 50) bg-blue-500 @else bg-red-800 @endif" style="width: {{ $percent }}%"></div>
                                        </div>
                                        <span class="text-[10px] @if($percent == 100) text-green-400 @else text-slate-500 @endif">{{ $score }}/{{ $total }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('quizzes.result', $log->id) }}" class="text-[10px] uppercase font-black theme-primary hover:underline transition-all">
                                        [ Review_Post_Mortem ]
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <p class="text-slate-500 uppercase tracking-widest text-xs font-black animate-pulse">
                                        // NO_RECORDS_FOUND_IN_SYSTEM_LOGS
                                    </p>
                                    <a href="{{ route('quizzes.index') }}" class="mt-4 inline-block theme-primary text-[10px] uppercase underline">Initialiser première mission</a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
