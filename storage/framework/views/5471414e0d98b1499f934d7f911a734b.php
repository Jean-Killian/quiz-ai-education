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
            <?php echo e(__('Liste des Quiz')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Quiz disponibles</h3>
                        <a href="<?php echo e(route('quizzes.generate')); ?>" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm transition">
                            ✨ Générer par IA
                        </a>
                    </div>
                    
                    <?php if(session('success')): ?>
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($quizzes->isEmpty()): ?>
                        <p>Aucun quiz n'est disponible pour le moment.</p>
                    <?php else: ?>
                        <ul class="space-y-4">
                            <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="border p-4 rounded bg-gray-50 flex justify-between items-center">
                                    <div>
                                        <div class="font-semibold text-lg"><?php echo e($quiz->title); ?></div>
                                        <div class="text-sm text-gray-600"><?php echo e($quiz->description); ?></div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <?php if(isset($userQuizzes[$quiz->id])): ?>
                                            <span class="text-sm font-medium text-green-600">
                                                Dernier score : <?php echo e($userQuizzes[$quiz->id]->pivot->score); ?> / <?php echo e($quiz->questions()->count()); ?>

                                            </span>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('quizzes.show', $quiz->id)); ?>" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                            Commencer
                                        </a>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    <?php endif; ?>
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
<?php /**PATH /home/jean_killian/Documents/Cours_Coding/ia/quiz-ai-education/resources/views/quizzes/index.blade.php ENDPATH**/ ?>