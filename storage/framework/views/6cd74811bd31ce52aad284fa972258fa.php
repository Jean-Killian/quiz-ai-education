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
            > HALL_OF_FAME // ACCESS_GRANTED
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700">
                <div class="p-6">
                    <div class="mb-8 border-b border-gray-700 pb-4">
                        <h3 class="text-xl font-mono text-green-500 font-bold uppercase tracking-[0.2em]">[ TOP_OPERATORS_BY_REPUTATION ]</h3>
                        <p class="text-gray-500 font-mono text-xs mt-1 uppercase tracking-widest">Listing des 50 meilleurs traqueurs du réseau.</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left font-mono text-sm border-separate border-spacing-y-2">
                            <thead>
                                <tr class="text-gray-500 uppercase tracking-widest text-[10px]">
                                    <th class="px-4 py-2 font-black">Rank</th>
                                    <th class="px-4 py-2 font-black">Operator_Alias</th>
                                    <th class="px-4 py-2 font-black text-right">Reputation_Points</th>
                                    <th class="px-4 py-2 font-black text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $isCurrentUser = ($user->id === auth()->id());
                                        $rank = $index + 1;
                                        $rowBg = $isCurrentUser ? 'bg-green-900/20 border-green-500/50' : 'bg-slate-900/50 border-slate-700';
                                        $textColor = $isCurrentUser ? 'text-green-400 font-bold' : 'text-slate-300';
                                    ?>
                                    <tr class="border rounded transition-all duration-300 transform hover:scale-[1.01] <?php echo e($rowBg); ?> <?php echo e($isCurrentUser ? 'shadow-[0_0_15px_rgba(34,197,94,0.1)]' : ''); ?>">
                                        <td class="px-4 py-3 font-black text-green-600">
                                            <?php if($rank == 1): ?> <span class="text-xl">🏆</span> <?php endif; ?>
                                            <?php if($rank == 2): ?> <span class="text-xl text-slate-400">🥈</span> <?php endif; ?>
                                            <?php if($rank == 3): ?> <span class="text-xl text-amber-700">🥉</span> <?php endif; ?>
                                            [<?php echo e(str_pad($rank, 2, '0', STR_PAD_LEFT)); ?>]
                                        </td>
                                        <td class="px-4 py-3 <?php echo e($textColor); ?>">
                                            <?php echo e($user->name); ?>

                                            <?php if($isCurrentUser): ?>
                                                <span class="ml-2 text-[10px] bg-green-500 text-black px-1 py-0.5 rounded font-black uppercase tracking-tighter">You</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 py-3 text-right font-black text-green-500">
                                            <?php echo e(number_format($user->global_score)); ?> XP
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <?php if($user->global_score > 5000): ?>
                                                <span class="text-[9px] border border-red-500 text-red-500 px-2 py-0.5 rounded uppercase font-black tracking-widest">Elite_Hunter</span>
                                            <?php elseif($user->global_score > 1000): ?>
                                                <span class="text-[9px] border border-green-500 text-green-500 px-2 py-0.5 rounded uppercase font-black tracking-widest">Active_Agent</span>
                                            <?php else: ?>
                                                <span class="text-[9px] border border-gray-600 text-gray-600 px-2 py-0.5 rounded uppercase font-black tracking-widest">Rookie_Op</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 border-t border-gray-700 pt-6 flex justify-between items-center text-[10px] font-mono text-gray-600 uppercase tracking-widest">
                        <span>Terminal_v2.0 // Secured_Connection</span>
                        <span>Total_Operators: <?php echo e(count($users)); ?></span>
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
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/leaderboard.blade.php ENDPATH**/ ?>