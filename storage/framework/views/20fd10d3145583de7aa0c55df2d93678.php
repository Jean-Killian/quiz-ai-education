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
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Résultats de : <?php echo e($quiz->title); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center py-10">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-2xl font-bold mb-4">Votre Score</h3>
                    
                    <div class="text-6xl font-extrabold text-blue-600 mb-6">
                        <?php echo e($score); ?> <span class="text-3xl text-gray-400">/ <?php echo e($totalQuestions); ?></span>
                    </div>

                    <p class="mb-8 text-gray-600">
                        <?php if($score == $totalQuestions): ?>
                            Félicitations, c'est un sans-faute !
                        <?php elseif($score >= $totalQuestions / 2): ?>
                            Pas mal du tout ! Encore un effort !
                        <?php else: ?>
                            Il va falloir réviser un peu...
                        <?php endif; ?>
                    </p>

                    <div class="flex justify-center space-x-4">
                        <a href="<?php echo e(route('quizzes.index')); ?>" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition font-medium border border-gray-300">
                            Retour à la liste
                        </a>
                        <a href="<?php echo e(route('quizzes.show', $quiz->id)); ?>" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition font-bold shadow">
                            Refaire le Quiz
                        </a>
                    </div>
                </div>
            </div>

            <?php if(session()->has('user_answers')): ?>
                <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-2xl font-black mb-6 text-gray-800 border-b pb-4">Correction détaillée</h4>
                    <div class="space-y-8">
                        <?php $__currentLoopData = $quiz->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <p class="font-bold text-lg text-gray-900 mb-3">
                                    <span class="text-indigo-600 mr-1">Q<?php echo e($index + 1); ?>.</span> <?php echo e($question->question_text); ?>

                                </p>
                                <div class="space-y-2 pl-6 border-l-4 border-indigo-100">
                                    <?php 
                                        $userAnswerId = session('user_answers')[$question->id] ?? null; 
                                    ?>
                                    <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $isUserChoice = ((string)$answer->id === (string)$userAnswerId);
                                            $bgClass = 'bg-gray-50 border-gray-200 text-gray-600';
                                            
                                            // Highlight logic
                                            if ($answer->is_correct) {
                                                $bgClass = 'bg-green-100 border-green-500 text-green-900 font-bold';
                                            } elseif ($isUserChoice && !$answer->is_correct) {
                                                $bgClass = 'bg-red-100 border-red-400 text-red-900 line-through opacity-80';
                                            }
                                        ?>
                                        <div class="p-3 border rounded-md flex justify-between items-center <?php echo e($bgClass); ?>">
                                            <span><?php echo e($answer->answer_text); ?></span>
                                            <div class="flex items-center space-x-2 text-sm">
                                                <?php if($isUserChoice): ?> <span class="bg-white px-2 py-1 rounded text-xs font-semibold shadow-sm text-gray-700">Sélectionné</span> <?php endif; ?>
                                                <?php if($answer->is_correct): ?> <span class="text-green-600 text-lg">✅</span> <?php endif; ?>
                                                <?php if($isUserChoice && !$answer->is_correct): ?> <span class="text-red-500 text-lg">❌</span> <?php endif; ?>
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