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
        > ARCHIVES_DES_TRAQUES
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-800 overflow-hidden shadow-2xl rounded border border-slate-700">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4 border-b border-slate-700 pb-6">
                        <div>
                            <h3 class="text-xl font-bold text-white uppercase tracking-tighter flex items-center gap-2">
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                Missions Disponibles
                            </h3>
                            <p class="text-[10px] text-slate-500 uppercase tracking-widest mt-1">Sélectionnez une cible pour lancer l'analyse de code.</p>
                        </div>
                        <a href="<?php echo e(route('quizzes.generate')); ?>" class="bg-green-600 hover:bg-green-500 text-black font-black py-2 px-6 rounded text-xs uppercase tracking-widest transition-all shadow-[0_0_15px_rgba(34,197,94,0.3)] flex items-center gap-2 group">
                            <span class="group-hover:translate-x-1 transition-transform">+ Générer_Cible()</span>
                        </a>
                    </div>
                    
                    <?php if(session('success')): ?>
                        <div class="bg-green-900/20 border border-green-500/50 text-green-400 px-4 py-3 rounded text-xs font-bold uppercase tracking-widest mb-8 flex items-center gap-3">
                            <span class="flex-shrink-0 animate-bounce">✓</span>
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($quizzes->isEmpty()): ?>
                        <div class="py-20 text-center">
                            <div class="text-slate-700 text-5xl mb-4 text-center mx-auto">∅</div>
                            <p class="text-slate-500 font-mono text-xs uppercase tracking-[0.3em]">Aucune cible détectée dans le périmètre.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 gap-4">
                            <?php $__currentLoopData = $quizzes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="group bg-slate-900/50 border border-slate-700 p-5 rounded hover:border-green-500/50 transition-all flex flex-col md:flex-row justify-between items-center gap-4 relative overflow-hidden">
                                    <!-- Scanlines effect -->
                                    <div class="absolute inset-0 bg-[linear-gradient(rgba(18,16,16,0)_50%,rgba(0,0,0,0.1)_50%),linear-gradient(90deg,rgba(255,0,0,0.03),rgba(0,255,0,0.01),rgba(0,0,255,0.03))] bg-[length:100%_2px,3px_100%] pointer-events-none opacity-20"></div>
                                    
                                    <div class="relative z-10 flex items-center gap-4 w-full">
                                        <div class="w-10 h-10 bg-slate-800 rounded flex items-center justify-center border border-slate-700 text-green-500 group-hover:scale-110 transition-transform">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                        </div>
                                        <div>
                                            <div class="font-bold text-white text-lg tracking-tight uppercase group-hover:text-green-400 transition-colors"><?php echo e($quiz->title); ?></div>
                                            <div class="text-[10px] text-slate-500 uppercase tracking-widest mt-0.5"><?php echo e($quiz->description); ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="relative z-10 flex items-center gap-6 w-full md:w-auto justify-between md:justify-end border-t md:border-t-0 border-slate-800 pt-4 md:pt-0">
                                        <?php if(isset($userQuizzes[$quiz->id])): ?>
                                            <div class="flex flex-col items-end">
                                                <span class="text-[9px] text-slate-600 uppercase font-bold tracking-[0.2em]">Dernière extraction</span>
                                                <span class="text-xs font-mono font-bold text-green-500/80">
                                                    <?php echo e($userQuizzes[$quiz->id]->pivot->score); ?> / <?php echo e($quiz->questions()->count()); ?>

                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        <a href="<?php echo e(route('quizzes.show', $quiz->id)); ?>" class="px-5 py-2 border border-slate-600 text-slate-400 text-[10px] font-black uppercase tracking-[0.2em] rounded-sm hover:bg-green-600 hover:border-green-600 hover:text-black transition-all">
                                            > Lancer_Hack
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
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
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/quizzes/index.blade.php ENDPATH**/ ?>