<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                            <a href="{{ route('quizzes.index') }}" class="text-white font-bold text-xl tracking-tighter flex items-center gap-2">
                                <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                                BugHunter<span class="text-green-500">_</span>AI
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center gap-6">
                        <!-- Navigation Links (Left Group) -->
                        <div class="hidden lg:flex items-center space-x-4 border-r border-slate-800 pr-6">
                            <a href="{{ route('quizzes.index') }}" class="px-3 py-1.5 rounded text-[10px] uppercase tracking-widest font-bold {{ request()->routeIs('quizzes.index') ? 'bg-green-500 text-black shadow-[0_0_10px_rgba(34,197,94,0.5)]' : 'text-slate-500 hover:text-slate-300' }} transition-all">Archives_Cibles</a>
                            <a href="{{ route('quizzes.generate') }}" class="px-3 py-1.5 rounded text-[10px] uppercase tracking-widest font-bold {{ request()->routeIs('quizzes.generate') ? 'bg-green-500 text-black shadow-[0_0_10px_rgba(34,197,94,0.5)]' : 'text-slate-500 hover:text-slate-300' }} transition-all">Initialiser_Traque</a>
                        </div>

                        <!-- Global Score (Compact) -->
                        <div class="flex items-center gap-2 bg-slate-950/50 border border-green-500/20 px-3 py-1.5 rounded shadow-inner">
                            <span class="text-green-600 text-[8px] font-black uppercase tracking-tighter">Rep</span>
                            <span class="text-green-400 text-xs font-black font-mono">{{ number_format(auth()->user()->global_score ?? 0) }}</span>
                        </div>

                        <!-- Operator Hub (Dropdown) -->
                        <div class="relative group">
                            <button id="hubToggle" class="flex items-center gap-3 bg-slate-800 hover:bg-slate-700 px-4 py-2 border border-slate-700 rounded-sm transition-all group-hover:border-green-500/50">
                                <div class="size-6 rounded-sm border border-green-500/30 overflow-hidden bg-slate-900 hidden md:block">
                                    <img src="{{ auth()->user()->avatar_url }}" alt="AV" class="w-full h-full object-cover">
                                </div>
                                <span class="text-[10px] uppercase tracking-widest font-black text-slate-300">Operator_Hub</span>
                                <svg class="w-3 h-3 text-slate-500 group-hover:text-green-500 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div id="hubMenu" class="absolute right-0 mt-2 w-56 bg-slate-900 border border-slate-700 rounded shadow-2xl invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all z-50 py-2">
                                <div class="px-4 py-2 border-b border-slate-800 mb-2">
                                    <span class="block text-[8px] uppercase tracking-widest text-slate-500">Status</span>
                                    <span class="block text-xs font-bold text-green-500">{{ auth()->user()->name }} // ACTIVE</span>
                                </div>

                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-[10px] uppercase tracking-widest font-bold text-slate-300 hover:bg-slate-800 hover:text-green-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Profil_Perso
                                </a>

                                <a href="{{ route('leaderboard') }}" class="flex items-center gap-3 px-4 py-2 text-[10px] uppercase tracking-widest font-bold text-slate-300 hover:bg-slate-800 hover:text-green-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                    Leaderboard
                                </a>

                                <div class="px-4 py-2 border-t border-slate-800 mt-2 flex items-center justify-between">
                                    <span class="text-[10px] uppercase font-bold text-slate-500">SFX_Engine</span>
                                    <button id="muteToggle" class="text-slate-500 hover:text-green-400 transition-colors p-1" title="Mute/Unmute">
                                        <svg id="iconVolumeOn" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path></svg>
                                        <svg id="iconVolumeOff" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" opacity=".5"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path></svg>
                                    </button>
                                </div>

                                <form method="POST" action="{{ route('logout') }}" class="px-2 pt-2 border-t border-slate-800">
                                    @csrf
                                    <button type="submit" class="w-full text-left flex items-center gap-3 px-2 py-2 text-[10px] uppercase tracking-widest font-black text-red-500 hover:bg-red-950/30 transition-colors rounded">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        [ Terminate_Login ]
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Subheader (Terminal path) -->
        @isset($header)
            <header class="bg-slate-800/50 border-b border-slate-800 shadow-sm">
                <div class="max-w-7xl mx-auto py-3 px-4 sm:px-6 lg:px-8 text-xs font-mono text-slate-500 uppercase tracking-widest">
                    <span class="text-green-600">root@bughunter</span>:{{ request()->path() }}$ {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Main Workspace -->
        <main class="flex-grow py-8">
            {{ $slot }}
        </main>

        <footer class="py-10 border-t border-slate-800 text-center">
            <p class="text-[10px] text-slate-600 uppercase tracking-widest">
                &copy; {{ date('Y') }} BUX_HUNTER_V2.0 // SYSTEM CORE ATTACHED
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
