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
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-bold text-xl text-green-400 leading-tight font-mono">
            > RAPPORT DE SÉCURITÉ : <?php echo e($quiz->title); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 theme-bg-deep min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Badge Unlock Notification -->
            <?php if(session('unlocked_badges') && count(session('unlocked_badges')) > 0): ?>
                <div class="mb-8 p-4 theme-bg-panel border-2 theme-border-primary theme-glow rounded-lg animate-pulse">
                    <div class="flex items-center gap-4">
                        <div class="theme-primary">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <h4 class="text-white font-black uppercase tracking-widest text-sm">Operator_Skill_Unlocked!!</h4>
                            <p class="theme-primary text-[10px] font-mono uppercase tracking-widest">
                                New Badges: <?php echo e(implode(', ', session('unlocked_badges'))); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="theme-bg-panel overflow-hidden shadow-2xl sm:rounded-lg border theme-border text-center py-10 mb-8 theme-glow">
                <div class="p-6">
                    <h3 class="text-xl font-mono tracking-widest text-gray-500 mb-4 uppercase">[ Mission_Efficiency_Report ]</h3>
                    
                    <div class="text-7xl font-mono font-black theme-primary mb-2 drop-shadow-[0_0_15px_var(--primary-glow)]">
                        <?php echo e($score); ?> <span class="text-4xl text-gray-600">/ <?php echo e($totalQuestions); ?></span>
                    </div>

                    <?php if(session('gained_points')): ?>
                        <div class="mb-6 inline-block px-4 py-1 bg-black/30 border theme-border-primary rounded-full text-xs font-bold theme-primary animate-bounce">
                            + <?php echo e(session('gained_points')); ?> XP // UPLOADED_TO_CORE
                        </div>
                    <?php endif; ?>

                    <p class="mb-8 font-mono text-lg <?php echo e($score >= ($totalQuestions/2) ? 'theme-primary' : 'text-red-500'); ?> uppercase tracking-widest">
                        <?php if($score == $totalQuestions): ?>
                            [+] SYSTEM_FULLY_SECURED. ZERO_VULNS_DETECTED.
                        <?php elseif($score >= $totalQuestions / 2): ?>
                            [!] SYSTEM_PARTIALLY_PATCHED. STABILIZING...
                        <?php else: ?>
                            [-] CRITICAL_FAILURE. HOST_COMPROMISED.
                        <?php endif; ?>
                    </p>

                    <div class="flex justify-center flex-wrap gap-4 border-t theme-border pt-8 mt-4">
                        <a href="<?php echo e(route('logs')); ?>" class="px-6 py-2 theme-bg-deep theme-primary border theme-border-primary rounded-sm hover:theme-bg-panel transition font-mono uppercase tracking-wide text-xs">
                            < Voir les Logs
                        </a>
                        <a href="<?php echo e(route('quizzes.index')); ?>" class="px-6 py-2 bg-slate-800 text-gray-400 border border-slate-700 rounded-sm hover:text-white transition font-mono uppercase tracking-wide text-xs">
                            Retour au Hub
                        </a>
                        <a href="<?php echo e(route('quizzes.show', $quiz->id)); ?>" class="px-6 py-2 theme-bg-deep theme-primary border-2 theme-border-primary rounded-sm hover:theme-bg-panel transition font-mono font-black uppercase shadow-[0_0_15px_var(--primary-glow)] text-xs">
                            > Re_Init_Traque()
                        </a>
                    </div>
                </div>
            </div>

            <?php if(session()->has('user_answers')): ?>
                <div class="theme-bg-panel overflow-hidden shadow-2xl sm:rounded-lg border theme-border p-6">
                    <h4 class="text-xl font-mono theme-primary mb-6 border-b theme-border pb-4 uppercase">> Post_Mortem_Data_Stream</h4>
                    <div class="space-y-8">
                        <?php $__currentLoopData = $quiz->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="theme-bg-deep p-5 rounded border theme-border">
                                <p class="font-mono text-sm text-gray-300 mb-4 bg-black/40 p-3 border theme-border rounded break-all whitespace-pre-wrap font-bold">
                                    <span class="theme-primary mr-2">#<?php echo e($index + 1); ?></span> <?php echo e(strip_tags($question->question_text)); ?>

                                </p>
                                <div class="space-y-2">
                                    <?php 
                                        $userAnswerId = session('user_answers')[$question->id] ?? null; 
                                    ?>
                                    <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $isUserChoice = ((string)$answer->id === (string)$userAnswerId);
                                            $bgClass = 'bg-slate-800 border-slate-700 text-gray-500';
                                            
                                            if ($answer->is_correct) {
                                                $bgClass = 'bg-green-900/30 border-green-500 text-green-400 font-bold shadow-[inset_4px_0_0_rgb(34,197,94)]';
                                            } elseif ($isUserChoice && !$answer->is_correct) {
                                                $bgClass = 'bg-red-900/30 border-red-500 text-red-400 line-through opacity-80 shadow-[inset_4px_0_0_rgb(239,68,68)]';
                                            }
                                        ?>
                                        <div class="p-3 border rounded-sm flex justify-between items-center font-mono text-sm transition-all <?php echo e($bgClass); ?>">
                                            <span><?php echo e($answer->answer_text); ?></span>
                                            <div class="flex items-center space-x-3">
                                                <?php if($isUserChoice): ?> <span class="bg-black/50 px-2 py-1 border border-white/10 text-[10px] tracking-widest text-slate-400 uppercase">Deployé</span> <?php endif; ?>
                                                <?php if($answer->is_correct): ?> <span class="text-green-500 font-black">✔ SQUASHED</span> <?php endif; ?>
                                                <?php if($isUserChoice && !$answer->is_correct): ?> <span class="text-red-500 animate-pulse font-black">✖ CRASHED</span> <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    
                                    <?php if($question->explanation): ?>
                                        <div class="mt-6 border-l-2 theme-border-primary bg-black/30 p-4 rounded-r shadow-inner">
                                            <div class="flex items-center gap-2 mb-2">
                                                <span class="theme-primary text-[10px] font-black uppercase tracking-[0.2em] theme-bg-deep px-2 py-0.5 rounded border theme-border">Expert_Analysis</span>
                                                <div class="h-px flex-grow theme-border opacity-30"></div>
                                            </div>
                                            <p class="text-[11px] font-mono text-slate-300 leading-relaxed typewriter-text" data-text="<?php echo e($question->explanation); ?>">
                                                <!-- Typing anim here -->
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Audio Feedback
            if (window.BugHunterAudio) {
                const score = <?php echo e($score); ?>;
                const perfect = <?php echo e($score == $totalQuestions ? 'true' : 'false'); ?>;
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
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/quizzes/result.blade.php ENDPATH**/ ?>