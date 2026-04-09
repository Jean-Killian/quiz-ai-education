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
                            <a href="<?php echo e(route('profile.edit')); ?>" class="text-[10px] uppercase tracking-widest font-bold <?php echo e(request()->routeIs('profile.edit') ? 'text-green-500' : 'text-slate-500 hover:text-slate-300'); ?>">Profil_Opérateur</a>
                        </div>

                        <!-- Mute Toggle -->
                        <button id="muteToggle" class="text-slate-500 hover:text-green-400 transition-colors p-1 rounded border border-slate-800 bg-slate-900/50" title="Activer/Désactiver les SFX">
                            <svg id="iconVolumeOn" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path></svg>
                            <svg id="iconVolumeOff" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" opacity=".5"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path></svg>
                        </button>

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

    <!-- SFX Engine -->
    <script>
        const SFX = {
            click: new Audio('https://www.soundjay.com/buttons/button-16.mp3'),
            success: new Audio('https://www.soundjay.com/buttons/button-3.mp3'),
            error: new Audio('https://www.soundjay.com/buttons/button-10.mp3')
        };

        // Configuration du volume
        Object.values(SFX).forEach(audio => {
            audio.volume = 0.2;
        });

        const muteToggle = document.getElementById('muteToggle');
        const iconOn = document.getElementById('iconVolumeOn');
        const iconOff = document.getElementById('iconVolumeOff');

        let isMuted = localStorage.getItem('hg_muted') === 'true';

        function updateUI() {
            if (isMuted) {
                iconOn.classList.add('hidden');
                iconOff.classList.remove('hidden');
            } else {
                iconOn.classList.remove('hidden');
                iconOff.classList.add('hidden');
            }
        }

        function playSound(sound) {
            if (isMuted) return;
            const audio = SFX[sound];
            if (audio) {
                audio.currentTime = 0;
                audio.play().catch(e => console.log('Audio play blocked'));
            }
        }

        muteToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            isMuted = !isMuted;
            localStorage.setItem('hg_muted', isMuted);
            updateUI();
            if (!isMuted) playSound('click');
        });

        // Global Click Listener for buttons and links
        document.addEventListener('click', (e) => {
            const target = e.target.closest('button, a');
            if (target && target.id !== 'muteToggle') {
                playSound('click');
            }
        });

        // Initialize UI
        updateUI();

        // Exporter pour un usage spécifique (ex: résultats quiz)
        window.BugHunterAudio = { play: playSound };
    </script>
</body>
</html>
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/layouts/app.blade.php ENDPATH**/ ?>