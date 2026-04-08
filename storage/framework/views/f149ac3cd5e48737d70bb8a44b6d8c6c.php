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
                        <a href="<?php echo e(route('quizzes.index')); ?>" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                            Retour à la liste
                        </a>
                        <a href="<?php echo e(route('quizzes.show', $quiz->id)); ?>" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Refaire le Quiz
                        </a>
                    </div>
                </div>
            </div>
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
<?php /**PATH /home/jean_killian/Documents/Cours_Coding/ia/quiz-ai-education/resources/views/quizzes/result.blade.php ENDPATH**/ ?>