<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Quiz AI Generator</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- CDN Tailwind for 100% disconnect from old assets -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased justify-center bg-gray-50">
    <div class="min-h-screen">
        
        <!-- Navbar Minimaliste -->
        <nav class="bg-indigo-600 shadow-md border-b border-indigo-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="<?php echo e(route('quizzes.index')); ?>" class="text-white font-black text-2xl tracking-tighter">
                                ✨ Quiz AI
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center space-x-6">
                        <span class="text-indigo-100 text-sm font-medium"><?php echo e(auth()->user()->name ?? 'Utilisateur'); ?></span>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="bg-indigo-800 hover:bg-indigo-900 text-white px-3 py-1.5 rounded-md text-sm font-bold transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        <?php if(isset($header)): ?>
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-gray-800">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <!-- Page Content -->
        <main class="mt-6">
            <?php echo e($slot); ?>

        </main>

        <footer class="mt-16 py-6 text-center text-gray-400 text-sm">
            &copy; <?php echo e(date('Y')); ?> Quiz AI Generator. Un projet minimaliste.
        </footer>
    </div>
</body>
</html>
<?php /**PATH C:\Users\golde\Documents\GitHub\AI_slop\quiz-ai-education\resources\views/layouts/app.blade.php ENDPATH**/ ?>