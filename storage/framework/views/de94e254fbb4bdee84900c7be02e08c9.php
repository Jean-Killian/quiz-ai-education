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
        <h2 class="font-bold text-xl theme-primary leading-tight font-mono">
            > MISSION_LOGS // ACCESSING_RECORDS
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 theme-bg-deep min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="theme-bg-panel theme-border border-2 rounded-lg overflow-hidden theme-glow">
                <div class="p-6 border-b theme-border bg-black/20 flex justify-between items-center">
                    <div>
                        <h3 class="text-white font-black uppercase tracking-widest text-lg font-mono">Operation_History</h3>
                        <p class="text-[10px] text-slate-500 uppercase tracking-widest mt-1">Total_Missions_Analyzed: <?php echo e($logs->count()); ?></p>
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
                            <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-white/5 transition-colors group">
                                <td class="px-6 py-4 text-xs text-slate-400">
                                    <?php echo e($log->pivot->created_at->format('Y.m.d H:i')); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-white font-bold text-xs uppercase"><?php echo e($log->title); ?></span>
                                        <span class="text-[9px] text-slate-600">ID: <?php echo e(substr($log->id, 0, 8)); ?>...</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] px-2 py-0.5 rounded border 
                                        <?php if($log->difficulty === 'Senior'): ?> border-red-500/50 text-red-400 bg-red-500/10
                                        <?php elseif($log->difficulty === 'Medior'): ?> border-yellow-500/50 text-yellow-400 bg-yellow-500/10
                                        <?php else: ?> border-blue-500/50 text-blue-400 bg-blue-500/10 <?php endif; ?> uppercase font-black">
                                        <?php echo e($log->difficulty); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <?php
                                        $total = $log->questions()->count();
                                        $score = $log->pivot->score;
                                        $percent = ($total > 0) ? ($score / $total) * 100 : 0;
                                    ?>
                                    <div class="flex flex-col items-center">
                                        <div class="w-20 h-1.5 bg-slate-800 rounded-full overflow-hidden mb-1">
                                            <div class="h-full <?php if($percent == 100): ?> bg-green-500 <?php elseif($percent > 50): ?> bg-blue-500 <?php else: ?> bg-red-800 <?php endif; ?>" style="width: <?php echo e($percent); ?>%"></div>
                                        </div>
                                        <span class="text-[10px] <?php if($percent == 100): ?> text-green-400 <?php else: ?> text-slate-500 <?php endif; ?>"><?php echo e($score); ?>/<?php echo e($total); ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="<?php echo e(route('quizzes.result', $log->id)); ?>" class="text-[10px] uppercase font-black theme-primary hover:underline transition-all">
                                        [ Review_Post_Mortem ]
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <p class="text-slate-500 uppercase tracking-widest text-xs font-black animate-pulse">
                                        // NO_RECORDS_FOUND_IN_SYSTEM_LOGS
                                    </p>
                                    <a href="<?php echo e(route('quizzes.index')); ?>" class="mt-4 inline-block theme-primary text-[10px] uppercase underline">Initialiser première mission</a>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/quizzes/logs.blade.php ENDPATH**/ ?>