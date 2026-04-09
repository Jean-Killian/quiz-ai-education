<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Login - Quiz AI</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,800&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="/">
                <h1 class="text-5xl font-black text-indigo-600 tracking-tighter">✨ Quiz AI</h1>
            </a>
            <p class="mt-2 text-gray-500">Générez des quiz adaptés grâce à l'IA</p>
        </div>

        <div class="px-8 py-8 bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-2xl border border-gray-100">
            <?php echo e($slot); ?>

        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\golde\Documents\GitHub\AI_slop\quiz-ai-education\resources\views/layouts/guest.blade.php ENDPATH**/ ?>