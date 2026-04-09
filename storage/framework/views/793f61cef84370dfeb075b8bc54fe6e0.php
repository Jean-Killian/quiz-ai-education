<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12 theme-bg-deep min-h-screen font-mono" id="duel-arena">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Combat HUD -->
            <div class="flex justify-between items-center mb-8 theme-bg-panel p-4 border-2 theme-border-primary theme-glow rounded relative overflow-hidden">
                <div class="flex items-center gap-4">
                    <div class="size-12 rounded border theme-border overflow-hidden">
                        <img src="<?php echo e(auth()->user()->avatar_url); ?>" alt="" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="text-[10px] text-slate-500 uppercase tracking-tighter">Attaquant</div>
                        <div class="text-xs font-black theme-primary uppercase"><?php echo e(auth()->user()->name); ?></div>
                    </div>
                </div>

                <div class="text-center">
                    <div class="text-[2rem] font-black theme-primary" id="timer">00:00.000</div>
                    <div class="text-[10px] theme-primary animate-pulse tracking-[0.3em]">CHRONO_ACTIF</div>
                </div>

                <div class="flex items-center gap-4 text-right">
                    <div>
                        <div class="text-[10px] text-slate-500 uppercase tracking-tighter">Cible</div>
                        <div class="text-xs font-black text-white uppercase">
                            <?php echo e(auth()->id() === $duel->challenger_id ? $duel->defender->name : $duel->challenger->name); ?>

                        </div>
                    </div>
                    <div class="size-12 rounded border theme-border overflow-hidden">
                        <img src="<?php echo e(auth()->id() === $duel->challenger_id ? $duel->defender->avatar_url : $duel->challenger->avatar_url); ?>" alt="" class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Quiz Container -->
            <div class="theme-bg-panel border theme-border rounded p-8 min-h-[400px] flex flex-col justify-center relative overflow-hidden">
                <!-- Static effect -->
                <div class="absolute inset-0 bg-black opacity-10 pointer-events-none" id="static-overlay"></div>
                
                <div id="quiz-content">
                    <?php $__currentLoopData = $quiz->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="question-step hidden" data-index="<?php echo e($index); ?>" data-id="<?php echo e($question->id); ?>">
                            <div class="mb-8">
                                <span class="theme-primary text-xs font-black mb-2 block">> Q_<?php echo e($index + 1); ?> / <?php echo e($quiz->questions->count()); ?></span>
                                <h3 class="text-xl text-white font-bold leading-relaxed break-all whitespace-pre-wrap">
                                    <?php echo e(strip_tags($question->question_text)); ?>

                                </h3>
                            </div>

                            <div class="grid grid-cols-1 gap-3">
                                <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button class="answer-btn text-left p-4 theme-bg-deep border theme-border rounded hover:theme-border-primary hover:theme-bg-panel transition-all group flex justify-between items-center" 
                                            data-answer-id="<?php echo e($answer->id); ?>" 
                                            data-correct="<?php echo e($answer->is_correct); ?>">
                                        <span class="text-slate-300 group-hover:text-white transition-colors"><?php echo e($answer->answer_text); ?></span>
                                        <span class="theme-primary opacity-0 group-hover:opacity-100 transition-opacity text-[10px] font-black uppercase">[ SELECT ]</span>
                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Start Screen -->
                <div id="start-screen" class="text-center py-20">
                    <h2 class="text-3xl font-black theme-primary mb-4 uppercase tracking-[0.5em]">Ready_To_Hack?</h2>
                    <p class="text-slate-500 mb-8 max-w-md mx-auto">La rapidité est la clé. Chaque seconde compte autant que la précision.</p>
                    <button id="start-btn" class="px-12 py-4 theme-bg-deep border-2 theme-border-primary theme-primary font-black uppercase tracking-[0.2em] shadow-[0_0_20px_var(--primary-glow)] hover:theme-bg-panel transition-all">
                        INITIALISER_LA_TRAQUE()
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let startTime, timerInterval;
            let currentQuestion = 0;
            let score = 0;
            const totalQuestions = <?php echo e($quiz->questions->count()); ?>;
            const timerEl = document.getElementById('timer');
            const startBtn = document.getElementById('start-btn');
            const startScreen = document.getElementById('start-screen');
            const questions = document.querySelectorAll('.question-step');

            function updateTimer() {
                const now = performance.now();
                const delta = now - startTime;
                const minutes = Math.floor(delta / 60000);
                const seconds = Math.floor((delta % 60000) / 1000);
                const ms = Math.floor(delta % 1000);
                timerEl.textContent = 
                    `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}.${ms.toString().padStart(3, '0')}`;
            }

            startBtn.addEventListener('click', () => {
                startScreen.classList.add('hidden');
                questions[0].classList.remove('hidden');
                startTime = performance.now();
                timerInterval = setInterval(updateTimer, 10);
                if (window.BugHunterAudio) window.BugHunterAudio.play('click');
            });

            document.querySelectorAll('.answer-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const isCorrect = this.getAttribute('data-correct') === '1';
                    if (isCorrect) {
                        score++;
                        if (window.BugHunterAudio) window.BugHunterAudio.play('success');
                    } else {
                        if (window.BugHunterAudio) window.BugHunterAudio.play('error');
                    }

                    questions[currentQuestion].classList.add('hidden');
                    currentQuestion++;

                    if (currentQuestion < totalQuestions) {
                        questions[currentQuestion].classList.remove('hidden');
                    } else {
                        finishDuel();
                    }
                });
            });

            function finishDuel() {
                clearInterval(timerInterval);
                const finalTimeMs = Math.floor(performance.now() - startTime);
                
                // Show finishing state
                document.getElementById('quiz-content').innerHTML = `
                    <div class="text-center py-20">
                        <div class="theme-primary text-xl font-black mb-4 animate-pulse">TRANSMISSION_DES_RESULTATS...</div>
                        <div class="w-full h-1 bg-slate-800 rounded-full overflow-hidden">
                            <div class="h-full theme-bg-deep" style="width: 100%; animation: slide 2s linear infinite; background-color: rgb(var(--primary))"></div>
                        </div>
                    </div>
                `;

                fetch("<?php echo e(route('duels.submit', $duel->id)); ?>", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    body: JSON.stringify({
                        score: score,
                        time_ms: finalTimeMs
                    })
                }).then(() => {
                    window.location.href = "<?php echo e(route('duels.result', $duel->id)); ?>";
                });
            }
        });
    </script>

    <style>
        @keyframes slide {
            from { transform: translateX(-100%); }
            to { transform: translateX(100%); }
        }
    </style>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/duels/play.blade.php ENDPATH**/ ?>