<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-green-400 leading-tight font-mono">
            > RAPPORT DE SÉCURITÉ : {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700 text-center py-10 mb-8">
                <div class="p-6">
                    <h3 class="text-xl font-mono tracking-widest text-gray-500 mb-4">[ BUGS SQUASHED ]</h3>
                    
                    <div class="text-7xl font-mono font-black text-green-500 mb-6 drop-shadow-[0_0_15px_rgba(34,197,94,0.5)]">
                        {{ $score }} <span class="text-4xl text-gray-600">/ {{ $totalQuestions }}</span>
                    </div>

                    <p class="mb-8 font-mono text-lg {{ $score >= ($totalQuestions/2) ? 'text-green-400' : 'text-red-500' }}">
                        @if($score == $totalQuestions)
                            [+] SYSTEM FULLY SECURED. ZERO VULNERABILITIES.
                        @elseif($score >= $totalQuestions / 2)
                            [!] SYSTEM PARTIALLY SECURED. PATCHES REQUIRED.
                        @else
                            [-] CRITICAL FAILURE. SYSTEM COMPROMISED.
                        @endif
                    </p>

                    <div class="flex justify-center space-x-4 border-t border-gray-700 pt-8 mt-4">
                        <a href="{{ route('quizzes.index') }}" class="px-6 py-2 bg-slate-800 text-gray-400 border border-gray-600 rounded-sm hover:text-white transition font-mono uppercase tracking-wide">
                            < Retour au Hub
                        </a>
                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="px-6 py-2 bg-green-900/50 text-green-400 border border-green-500 rounded-sm hover:bg-green-500 hover:text-black transition font-mono font-bold uppercase shadow-[0_0_10px_rgba(34,197,94,0.2)]">
                            > Relancer la Traque
                        </a>
                    </div>
                </div>
            </div>

            @if(session()->has('user_answers'))
                <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700 p-6">
                    <h4 class="text-xl font-mono text-green-400 mb-6 border-b border-gray-700 pb-4">> POST-MORTEM (LOGS)</h4>
                    <div class="space-y-8">
                        @foreach($quiz->questions as $index => $question)
                            <div class="bg-slate-900 p-5 rounded border border-gray-700">
                                <p class="font-mono text-sm text-gray-300 mb-4 bg-slate-950 p-3 border border-slate-800 rounded break-all whitespace-pre-wrap font-bold">
                                    <span class="text-green-500 mr-2">#{{ $index + 1 }}</span> {{ strip_tags($question->question_text) }}
                                </p>
                                <div class="space-y-2">
                                    @php 
                                        $userAnswerId = session('user_answers')[$question->id] ?? null; 
                                    @endphp
                                    @foreach($question->answers as $answer)
                                        @php
                                            $isUserChoice = ((string)$answer->id === (string)$userAnswerId);
                                            $bgClass = 'bg-slate-800 border-gray-700 text-gray-500';
                                            
                                            if ($answer->is_correct) {
                                                $bgClass = 'bg-green-900/30 border-green-500 text-green-400 font-bold shadow-[inset_4px_0_0_rgba(34,197,94,1)]';
                                            } elseif ($isUserChoice && !$answer->is_correct) {
                                                $bgClass = 'bg-red-900/30 border-red-500 text-red-400 line-through opacity-80 shadow-[inset_4px_0_0_rgba(239,68,68,1)]';
                                            }
                                        @endphp
                                        <div class="p-3 border rounded-sm flex justify-between items-center font-mono text-sm transition-all {{ $bgClass }}">
                                            <span>{{ $answer->answer_text }}</span>
                                            <div class="flex items-center space-x-3">
                                                @if($isUserChoice) <span class="bg-slate-950 px-2 py-1 border border-gray-600 text-[10px] tracking-widest text-gray-400 uppercase">Deployé</span> @endif
                                                @if($answer->is_correct) <span class="text-green-500">✔ SQUASHED</span> @endif
                                                @if($isUserChoice && !$answer->is_correct) <span class="text-red-500 animate-pulse">✖ CRASHED</span> @endif
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- AI Explanation Block --}}
                                    @if($question->explanation)
                                        <div class="mt-6 border-l-2 border-green-500 bg-slate-950/50 p-4 rounded-r shadow-inner">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="text-green-500 text-[10px] font-black uppercase tracking-[0.2em] bg-green-950 px-2 py-0.5 rounded border border-green-500/30">Expert_Analysis</span>
                                                <div class="h-px flex-grow bg-green-900/30"></div>
                                            </div>
                                            <p class="text-xs font-mono text-slate-300 leading-relaxed italic">
                                                {{ $question->explanation }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
