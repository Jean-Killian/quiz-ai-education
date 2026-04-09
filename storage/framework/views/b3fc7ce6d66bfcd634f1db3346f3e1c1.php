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
            > INITIATING_HOSTILE_TAKEOVER // TARGET: <?php echo e($user->name); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 theme-bg-deep min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="theme-bg-panel theme-border theme-glow border-2 rounded-lg p-8">
                <div class="flex items-center gap-6 mb-8 border-b theme-border pb-6">
                    <div class="size-20 rounded border-2 theme-border-primary overflow-hidden shadow-[0_0_20px_var(--primary-glow)]">
                        <img src="<?php echo e($user->avatar_url); ?>" alt="" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-white uppercase tracking-widest">Défier Opérateur_Alias</h3>
                        <p class="theme-primary font-mono text-sm opacity-70">Cible : <?php echo e($user->name); ?> // Reputation : <?php echo e(number_format($user->global_score)); ?> XP</p>
                    </div>
                </div>

                <form action="<?php echo e(route('duels.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="defender_id" value="<?php echo e($user->id); ?>">

                    <div class="mb-8">
                        <label class="block theme-primary text-xs font-black uppercase tracking-[0.2em] mb-4">Sélectionner le Terrain de Combat (Mission) :</label>
                        <div class="grid grid-cols-1 gap-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                            <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="relative group cursor-pointer">
                                    <input type="radio" name="quiz_id" value="<?php echo e($quiz->id); ?>" class="peer hidden" required>
                                    <div class="p-4 theme-bg-deep border theme-border rounded group-hover:theme-border-primary transition-all peer-checked:theme-border-primary peer-checked:bg-white/5">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <div class="text-white font-bold text-sm uppercase"><?php echo e($quiz->title); ?></div>
                                                <div class="text-[10px] text-slate-500"><?php echo e($quiz->description); ?></div>
                                            </div>
                                            <div class="text-[10px] font-black theme-primary px-2 border theme-border-primary rounded">
                                                <?php echo e($quiz->difficulty); ?>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="absolute inset-y-0 left-0 w-1 theme-bg-deep group-hover:bg-green-500 peer-checked:bg-green-500 transition-all"></div>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="<?php echo e(route('leaderboard')); ?>" class="text-slate-500 hover:text-white text-[10px] uppercase font-bold tracking-widest transition-colors">
                            [ Aband_Mission ]
                        </a>
                        <button type="submit" class="px-8 py-3 theme-bg-deep border-2 theme-border-primary theme-primary font-black uppercase tracking-widest hover:theme-bg-panel transition-all shadow-[0_0_20px_var(--primary-glow)]">
                            LANCER_L_ATTAQUE_()
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgb(var(--primary)); border-radius: 10px; }
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
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/duels/create.blade.php ENDPATH**/ ?>