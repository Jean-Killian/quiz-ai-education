<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-green-400 leading-tight font-mono">
            > RAPPORT DE SÉCURITÉ : {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12 theme-bg-deep min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Badge Unlock Notification -->
            @if(session('unlocked_badges') && count(session('unlocked_badges')) > 0)
                <div class="mb-8 p-4 theme-bg-panel border-2 theme-border-primary theme-glow rounded-lg animate-pulse">
                    <div class="flex items-center gap-4">
                        <div class="theme-primary">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-black uppercase tracking-widest text-sm">Operator_Skill_Unlocked!!</h4>
                            <p class="theme-primary text-[10px] font-mono uppercase tracking-widest">
                                New Badges: {{ implode(', ', session('unlocked_badges')) }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="theme-bg-panel overflow-hidden shadow-2xl sm:rounded-lg border theme-border text-center py-10 mb-8 theme-glow">
                <div class="p-6">
                    <h3 class="text-xl font-mono tracking-widest text-gray-500 mb-4 uppercase">[ Mission_Efficiency_Report ]</h3>
                    
                    <div class="text-7xl font-mono font-black theme-primary mb-2 drop-shadow-[0_0_15px_var(--primary-glow)]">
                        {{ $score }} <span class="text-4xl text-gray-600">/ {{ $totalQuestions }}</span>
                    </div>

                    @if(session('gained_points'))
                        <div class="mb-6 inline-block px-4 py-1 bg-black/30 border theme-border-primary rounded-full text-xs font-bold theme-primary animate-bounce">
                            + {{ session('gained_points') }} XP // UPLOADED_TO_CORE
                        </div>
                    @endif

                    <p class="mb-8 font-mono text-lg {{ $score >= ($totalQuestions/2) ? 'theme-primary' : 'text-red-500' }} uppercase tracking-widest">
                        @if($score == $totalQuestions)
                            [+] SYSTEM_FULLY_SECURED. ZERO_VULNS_DETECTED.
                        @elseif($score >= $totalQuestions / 2)
                            [!] SYSTEM_PARTIALLY_PATCHED. STABILIZING...
                        @else
                            [-] CRITICAL_FAILURE. HOST_COMPROMISED.
                        @endif
                    </p>

                    <div class="flex justify-center flex-wrap gap-4 border-t theme-border pt-8 mt-4">
                        <a href="{{ route('logs') }}" class="px-6 py-2 theme-bg-deep theme-primary border theme-border-primary rounded-sm hover:theme-bg-panel transition font-mono uppercase tracking-wide text-xs">
                            < Voir les Logs
                        </a>
                        <a href="{{ route('quizzes.index') }}" class="px-6 py-2 bg-slate-800 text-gray-400 border border-slate-700 rounded-sm hover:text-white transition font-mono uppercase tracking-wide text-xs">
                            Retour au Hub
                        </a>
                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="px-6 py-2 theme-bg-deep theme-primary border-2 theme-border-primary rounded-sm hover:theme-bg-panel transition font-mono font-black uppercase shadow-[0_0_15px_var(--primary-glow)] text-xs">
                            > Re_Init_Traque()
                        </a>
                    </div>
                </div>
            </div>

            @if(session()->has('user_answers'))
                <div class="theme-bg-panel overflow-hidden shadow-2xl sm:rounded-lg border theme-border p-6">
                    <h4 class="text-xl font-mono theme-primary mb-6 border-b theme-border pb-4 uppercase">> Post_Mortem_Data_Stream</h4>
                    <div class="space-y-8">
                        @foreach($quiz->questions as $index => $question)
                            <div class="theme-bg-deep p-5 rounded border theme-border">
                                <p class="font-mono text-sm text-gray-300 mb-4 bg-black/40 p-3 border theme-border rounded break-all whitespace-pre-wrap font-bold">
                                    <span class="theme-primary mr-2">#{{ $index + 1 }}</span> {{ strip_tags($question->question_text) }}
                                </p>
                                <div class="space-y-2">
                                    @php 
                                        $userAnswerId = session('user_answers')[$question->id] ?? null; 
                                    @endphp
                                    @foreach($question->answers as $answer)
                                        @php
                                            $isUserChoice = ((string)$answer->id === (string)$userAnswerId);
                                            $bgClass = 'bg-slate-800 border-slate-700 text-gray-500';
                                            
                                            if ($answer->is_correct) {
                                                $bgClass = 'bg-green-900/30 border-green-500 text-green-400 font-bold shadow-[inset_4px_0_0_rgb(34,197,94)]';
                                            } elseif ($isUserChoice && !$answer->is_correct) {
                                                $bgClass = 'bg-red-900/30 border-red-500 text-red-400 line-through opacity-80 shadow-[inset_4px_0_0_rgb(239,68,68)]';
                                            }
                                        @endphp
                                        <div class="p-3 border rounded-sm flex justify-between items-center font-mono text-sm transition-all {{ $bgClass }}">
                                            <span>{{ $answer->answer_text }}</span>
                                            <div class="flex items-center space-x-3">
                                                @if($isUserChoice) <span class="bg-black/50 px-2 py-1 border border-white/10 text-[10px] tracking-widest text-slate-400 uppercase">Deployé</span> @endif
                                                @if($answer->is_correct) <span class="text-green-500 font-black">✔ SQUASHED</span> @endif
                                                @if($isUserChoice && !$answer->is_correct) <span class="text-red-500 animate-pulse font-black">✖ CRASHED</span> @endif
                                            </div>
                                        </div>
                                    @endforeach

                                    {{-- AI Explanation Block --}}
                                    @if($question->explanation)
                                        <div class="mt-6 border-l-2 theme-border-primary bg-black/30 p-4 rounded-r shadow-inner">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="theme-primary text-[10px] font-black uppercase tracking-[0.2em] theme-bg-deep px-2 py-0.5 rounded border theme-border">Expert_Analysis</span>
                                                <div class="h-px flex-grow theme-border opacity-30"></div>
                                            </div>
                                            <p class="text-[11px] font-mono text-slate-300 leading-relaxed typewriter-text" data-text="{{ $question->explanation }}">
                                                <!-- Typing anim here -->
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Audio Feedback
            if (window.BugHunterAudio) {
                const score = {{ $score }};
                const perfect = {{ $score == $totalQuestions ? 'true' : 'false' }};
                if (perfect) {
                    window.BugHunterAudio.play('success');
                } else if (score > 0) {
                    window.BugHunterAudio.play('click');
                } else {
                    window.BugHunterAudio.play('error');
                }
            }

            // Typewriter Effect
            const elements = document.querySelectorAll('.typewriter-text');
            elements.forEach((el, index) => {
                const text = el.getAttribute('data-text');
                el.textContent = '';
                let i = 0;
                
                // Delay based on index to make them appear one after another
                setTimeout(() => {
                    const timer = setInterval(() => {
                        if (i < text.length) {
                            el.textContent += text.charAt(i);
                            i++;
                            // Occasional SFX for typing? Too noisy maybe.
                        } else {
                            clearInterval(timer);
                        }
                    }, 15);
                }, index * 1000); 
            });
        });
    </script>
</x-app-layout>
