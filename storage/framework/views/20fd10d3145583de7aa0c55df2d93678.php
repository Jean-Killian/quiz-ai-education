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

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700 text-center py-10 mb-8">
                <div class="p-6">
                    <h3 class="text-xl font-mono tracking-widest text-gray-500 mb-4">[ BUGS SQUASHED ]</h3>
                    
                    <div class="text-7xl font-mono font-black text-green-500 mb-6 drop-shadow-[0_0_15px_rgba(34,197,94,0.5)]">
                        <?php echo e($score); ?> <span class="text-4xl text-gray-600">/ <?php echo e($totalQuestions); ?></span>
                    </div>

                    <p class="mb-8 font-mono text-lg <?php echo e($score >= ($totalQuestions/2) ? 'text-green-400' : 'text-red-500'); ?>">
                        <?php if($score == $totalQuestions): ?>
                            [+] SYSTEM FULLY SECURED. ZERO VULNERABILITIES.
                        <?php elseif($score >= $totalQuestions / 2): ?>
                            [!] SYSTEM PARTIALLY SECURED. PATCHES REQUIRED.
                        <?php else: ?>
                            [-] CRITICAL FAILURE. SYSTEM COMPROMISED.
                        <?php endif; ?>
                    </p>

                    <div class="flex justify-center space-x-4 border-t border-gray-700 pt-8 mt-4">
                        <a href="<?php echo e(route('quizzes.index')); ?>" class="px-6 py-2 bg-slate-800 text-gray-400 border border-gray-600 rounded-sm hover:text-white transition font-mono uppercase tracking-wide">
                            < Retour au Hub
                        </a>
                        <a href="<?php echo e(route('quizzes.show', $quiz->id)); ?>" class="px-6 py-2 bg-green-900/50 text-green-400 border border-green-500 rounded-sm hover:bg-green-500 hover:text-black transition font-mono font-bold uppercase shadow-[0_0_10px_rgba(34,197,94,0.2)]">
                            > Relancer la Traque
                        </a>
                    </div>
                </div>
            </div>

            <?php if(session()->has('user_answers')): ?>
                <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700 p-6">
                    <h4 class="text-xl font-mono text-green-400 mb-6 border-b border-gray-700 pb-4">> POST-MORTEM (LOGS)</h4>
                    <div class="space-y-8">
                        <?php $__currentLoopData = $quiz->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-slate-900 p-5 rounded border border-gray-700">
                                <p class="font-mono text-sm text-gray-300 mb-4 bg-slate-950 p-3 border border-slate-800 rounded break-all whitespace-pre-wrap font-bold">
                                    <span class="text-green-500 mr-2">#<?php echo e($index + 1); ?></span> <?php echo e(strip_tags($question->question_text)); ?>

                                </p>
                                <div class="space-y-2">
                                    <?php 
                                        $userAnswerId = session('user_answers')[$question->id] ?? null; 
                                    ?>
                                    <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $isUserChoice = ((string)$answer->id === (string)$userAnswerId);
                                            $bgClass = 'bg-slate-800 border-gray-700 text-gray-500';
                                            
                                            if ($answer->is_correct) {
                                                $bgClass = 'bg-green-900/30 border-green-500 text-green-400 font-bold shadow-[inset_4px_0_0_rgba(34,197,94,1)]';
                                            } elseif ($isUserChoice && !$answer->is_correct) {
                                                $bgClass = 'bg-red-900/30 border-red-500 text-red-400 line-through opacity-80 shadow-[inset_4px_0_0_rgba(239,68,68,1)]';
                                            }
                                        ?>
                                        <div class="p-3 border rounded-sm flex justify-between items-center font-mono text-sm transition-all <?php echo e($bgClass); ?>">
                                            <span><?php echo e($answer->answer_text); ?></span>
                                            <div class="flex items-center space-x-3">
                                                <?php if($isUserChoice): ?> <span class="bg-slate-950 px-2 py-1 border border-gray-600 text-[10px] tracking-widest text-gray-400 uppercase">Deployé</span> <?php endif; ?>
                                                <?php if($answer->is_correct): ?> <span class="text-green-500">✔ SQUASHED</span> <?php endif; ?>
                                                <?php if($isUserChoice && !$answer->is_correct): ?> <span class="text-red-500 animate-pulse">✖ CRASHED</span> <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
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