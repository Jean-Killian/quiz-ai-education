<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>

        <div class="mb-8 p-3 bg-slate-900 border-l-4 border-green-500">
            <h3 class="text-xl font-bold text-white uppercase tracking-tighter">Accès Opérateur</h3>
            <p class="text-[10px] text-slate-500 mt-1 uppercase tracking-widest leading-tight">Veuillez injecter vos identifiants de session.</p>
        </div>

        <!-- Role Indicator (Visual only) -->
        <div class="flex justify-between items-center px-3 py-2 bg-slate-900/50 rounded text-[10px] font-bold text-slate-500 mb-6 uppercase tracking-[0.2em] border border-slate-700">
            <span>Privilège : </span>
            <span class="text-green-500 animate-pulse">Invité_Std</span>
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Email_Address</label>
            <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner" placeholder="admin@bughunter.ai">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest">[ FAIL ] <?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Password_Crypted</label>
            <input id="password" type="password" name="password" required
                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner" placeholder="********">
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest">[ FAIL ] <?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="flex flex-col gap-4 mt-8">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-green-500 rounded bg-green-600 hover:bg-green-500 text-black text-xs font-black uppercase tracking-[0.3em] transition-all shadow-[0_0_15px_rgba(34,197,94,0.2)] active:scale-95">
                Authentifier()
            </button>
            
            <a href="<?php echo e(route('register')); ?>" class="text-[10px] text-slate-600 hover:text-green-400 text-center uppercase tracking-widest transition-colors">
                [ Créer un nouvel opérateur ]
            </a>
        </div>
    </form>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/auth/login.blade.php ENDPATH**/ ?>