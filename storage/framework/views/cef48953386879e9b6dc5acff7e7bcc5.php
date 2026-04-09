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
            > OPERATOR_REWARDS // SUCCESS_STREAM
        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 theme-bg-deep min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Global Progress Header (Steam Style) -->
            <div class="theme-bg-panel theme-border theme-glow border-2 rounded-lg p-8 mb-8 flex flex-col md:flex-row items-center gap-8">
                <div class="relative size-32 flex-shrink-0">
                    <svg class="size-full transform -rotate-90">
                        <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" class="text-slate-800" />
                        <circle cx="64" cy="64" r="58" stroke="currentColor" stroke-width="8" fill="transparent" class="theme-primary"
                            stroke-dasharray="<?php echo e(2 * pi() * 58); ?>"
                            stroke-dashoffset="<?php echo e((2 * pi() * 58) * (1 - $percent / 100)); ?>"
                            stroke-linecap="round" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-3xl font-black text-white"><?php echo e($percent); ?>%</span>
                        <span class="text-[8px] uppercase tracking-tighter text-slate-500">Completé</span>
                    </div>
                </div>

                <div class="flex-grow text-center md:text-left">
                    <h3 class="text-2xl font-black text-white uppercase tracking-widest mb-2">Hall_des_Succès</h3>
                    <p class="text-slate-400 font-mono text-sm mb-4">
                        Status de l'Opérateur : <span class="theme-primary font-bold">[<?php echo e($unlockedCount); ?> / <?php echo e($totalBadges); ?>] Médailles Collectées</span>
                    </p>
                    <div class="w-full h-3 bg-slate-800 rounded-full overflow-hidden border theme-border">
                        <div class="h-full theme-bg-deep theme-primary shadow-[0_0_10px_var(--primary-glow)] border-r-2 border-white/20 transition-all duration-1000" style="width: <?php echo e($percent); ?>%; background-color: rgb(var(--primary))"></div>
                    </div>
                </div>
            </div>

            <!-- Badges Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $allBadges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $unlocked = isset($userBadgeMap[$badge->id]);
                        $date = $unlocked ? $userBadgeMap[$badge->id]->pivot->created_at : null;
                    ?>
                    
                    <div class="relative group">
                        <div class="h-full p-6 border-2 transition-all duration-300 <?php echo e($unlocked ? 'theme-bg-panel theme-border-primary theme-glow' : 'bg-slate-900 border-slate-800 opacity-60 grayscale'); ?>">
                            
                            <div class="flex items-start gap-4">
                                <!-- Badge Icon -->
                                <div class="size-16 flex-shrink-0 rounded bg-black/40 border <?php echo e($unlocked ? 'theme-border-primary' : 'border-slate-700'); ?> flex items-center justify-center text-3xl shadow-inner overflow-hidden relative">
                                    <?php if($unlocked): ?>
                                        <div class="absolute inset-0 bg-gradient-to-br from-white/10 to-transparent"></div>
                                        <?php echo $badge->icon; ?>

                                    <?php else: ?>
                                        <svg class="size-6 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                    <?php endif; ?>
                                </div>

                                <div class="flex-grow">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="font-black text-sm uppercase tracking-widest <?php echo e($unlocked ? 'text-white' : 'text-slate-500'); ?>">
                                            <?php echo e($badge->name); ?>

                                        </h4>
                                        <?php if($unlocked): ?>
                                            <span class="text-[8px] bg-green-500/20 text-green-400 px-1.5 py-0.5 rounded border border-green-500/30 uppercase font-bold">Acquis</span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-xs font-mono <?php echo e($unlocked ? 'text-slate-300' : 'text-slate-600'); ?> mb-3">
                                        <?php echo e($badge->description); ?>

                                    </p>
                                    
                                    <?php if($unlocked): ?>
                                        <div class="text-[9px] text-slate-500 uppercase font-bold mt-auto border-t border-white/5 pt-2">
                                            Extraction : <?php echo e($date->format('d M Y')); ?>

                                        </div>
                                    <?php else: ?>
                                        <div class="flex items-center gap-2 text-[9px] text-slate-700 uppercase font-black tracking-tighter mt-auto border-t border-white/5 pt-2">
                                            <span class="animate-pulse">> SYSTEM_LOCKED</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php if($unlocked): ?>
                                <!-- Hover effect detail overlay -->
                                <div class="absolute inset-0 border-2 theme-border-primary opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none"></div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/achievements/index.blade.php ENDPATH**/ ?>