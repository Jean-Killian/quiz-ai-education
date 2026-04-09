<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>BugHunter AI - Mission Control</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=fira-code:400,600,700|inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['Fira Code', 'monospace'],
                    },
                }
            }
        }
    </script>
</head>
<body class="font-mono text-slate-300 antialiased bg-slate-900 border-t-4 border-green-600">
    <div class="min-h-screen flex flex-col">
        
        <!-- Terminal Style Navbar -->
        <nav class="bg-slate-900 border-b border-slate-800 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-4">
                        <div class="shrink-0 flex items-center">
                            <a href="<?php echo e(route('quizzes.index')); ?>" class="text-white font-bold text-xl tracking-tighter flex items-center gap-2">
                                <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                BugHunter<span class="text-green-500">_</span>AI
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center space-x-8">
                        <!-- Navigation Links -->
                        <div class="hidden lg:flex space-x-6 mr-4 border-r border-slate-800 pr-6">
                            <a href="<?php echo e(route('quizzes.index')); ?>" class="text-[10px] uppercase tracking-widest font-bold <?php echo e(request()->routeIs('quizzes.index') ? 'text-green-500' : 'text-slate-500 hover:text-slate-300'); ?>">Archives_Cibles</a>
                            <a href="<?php echo e(route('quizzes.generate')); ?>" class="text-[10px] uppercase tracking-widest font-bold <?php echo e(request()->routeIs('quizzes.generate') ? 'text-green-500' : 'text-slate-500 hover:text-slate-300'); ?>">Initialiser_Traque</a>
                            <a href="<?php echo e(route('leaderboard')); ?>" class="text-[10px] uppercase tracking-widest font-bold <?php echo e(request()->routeIs('leaderboard') ? 'text-green-500' : 'text-slate-500 hover:text-slate-300'); ?>">Classement_Elite</a>
                        </div>

                        <!-- Global Score -->
                        <div class="flex items-center gap-3 bg-green-950/30 border border-green-500/50 px-3 py-1.5 rounded shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                            <span class="text-green-600 text-[9px] font-black uppercase tracking-tighter">Reputation</span>
                            <span class="text-green-400 text-sm font-black"><?php echo e(auth()->user()->global_score ?? 0); ?> XP</span>
                        </div>

                        <div class="hidden md:flex flex-col items-end">
                            <span class="text-green-500 text-[10px] leading-none uppercase tracking-widest font-bold">Session active</span>
                            <span class="text-slate-400 text-xs"><?php echo e(auth()->user()->name ?? 'Opérateur'); ?></span>
                        </div>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="border border-red-900/50 bg-red-950/20 hover:bg-red-600 hover:text-white text-red-400 px-3 py-1 text-[10px] font-bold uppercase tracking-widest transition-all rounded-sm">
                                [ Terminate ]
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Subheader (Terminal path) -->
        <?php if(isset($header)): ?>
            <header class="bg-slate-800/50 border-b border-slate-800 shadow-sm">
                <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xs font-mono text-slate-500 uppercase tracking-widest">
                    <span class="text-green-600">root@bughunter</span>:<?php echo e(request()->path()); ?>$ <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <!-- Main Workspace -->
        <main class="flex-grow py-8">
            <?php echo e($slot); ?>

        </main>

        <footer class="py-10 border-t border-slate-800 text-center">
            <p class="text-[10px] text-slate-600 uppercase tracking-widest">
                &copy; <?php echo e(date('Y')); ?> BUX_HUNTER_V2.0 // SYSTEM CORE ATTACHED
            </p>
        </footer>
    </div>
</body>
</html>
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/layouts/app.blade.php ENDPATH**/ ?>