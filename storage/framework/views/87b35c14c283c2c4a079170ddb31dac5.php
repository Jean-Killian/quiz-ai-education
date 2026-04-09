<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'BugHunter AI')); ?></title>

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
<body class="font-mono text-slate-300 antialiased bg-slate-900 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <a href="/">
                <h1 class="text-4xl font-bold tracking-tighter text-white">
                    BugHunter<span class="text-green-500">_</span>AI
                </h1>
            </a>
            <p class="mt-2 text-slate-500 text-sm uppercase tracking-widest leading-relaxed">
                [ AUTHENTIFICATION OPÉRATEUR ]
            </p>
        </div>

        <div class="px-8 py-10 bg-slate-800 shadow-2xl rounded border border-slate-700 relative overflow-hidden">
            <!-- Decorative corner -->
            <div class="absolute top-0 right-0 w-16 h-16 bg-green-500/5 rotate-45 translate-x-8 -translate-y-8"></div>
            
            <?php echo e($slot); ?>

        </div>
        
        <div class="mt-8 text-center">
            <p class="text-[10px] text-slate-600 uppercase tracking-[0.2em]">© <?php echo e(date('Y')); ?> BUX_HUNTER MISSION CONTROL</p>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/layouts/guest.blade.php ENDPATH**/ ?>