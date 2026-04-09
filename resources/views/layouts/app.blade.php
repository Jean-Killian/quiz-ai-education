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
    </script>
    <style>
        :root {
            /* Theme: Matrix (Default) */
            --primary: 34, 197, 94; /* text-green-500 */
            --primary-glow: rgba(34, 197, 94, 0.4);
            --bg-deep: 15, 23, 42; /* bg-slate-900 */
            --bg-panel: 30, 41, 59; /* bg-slate-800 */
            --accent-red: 239, 68, 68; /* text-red-500 */
        }

        @auth
            @if(auth()->user()->theme === 'cyberpunk')
            :root {
                --primary: 217, 70, 239; /* text-fuchsia-500 */
                --primary-glow: rgba(217, 70, 239, 0.4);
                --bg-deep: 13, 10, 33; 
                --bg-panel: 29, 20, 64;
                --accent-red: 244, 63, 94;
            }
            @elseif(auth()->user()->theme === 'dark_web')
            :root {
                --primary: 239, 68, 68; /* text-red-500 */
                --primary-glow: rgba(239, 68, 68, 0.4);
                --bg-deep: 7, 7, 7;
                --bg-panel: 25, 25, 25;
                --accent-red: 220, 38, 38;
            }
            @elseif(auth()->user()->theme === 'bios')
            :root {
                --primary: 255, 255, 255; /* text-white */
                --primary-glow: rgba(255, 255, 255, 0.4);
                --bg-deep: 44, 62, 180; /* Blue BIOS */
                --bg-panel: 51, 77, 230;
                --accent-red: 253, 224, 71; /* yellow */
            }
            @endif
        @endauth

        .theme-primary { color: rgb(var(--primary)); }
        .theme-bg-deep { background-color: rgb(var(--bg-deep)); }
        .theme-bg-panel { background-color: rgb(var(--bg-panel)); }
        .theme-border { border-color: rgba(var(--primary), 0.3); }
        .theme-glow { box-shadow: 0 0 15px var(--primary-glow); }
        .theme-border-primary { border-color: rgb(var(--primary)); }
    </style>
</head>
<body class="font-mono text-slate-300 antialiased theme-bg-deep border-t-4 theme-border-primary">
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
                            <a href="{{ route('quizzes.index') }}" class="px-3 py-1.5 rounded text-[10px] uppercase tracking-widest font-bold {{ request()->routeIs('quizzes.index') ? 'theme-bg-deep theme-primary shadow-[0_0_10px_var(--primary-glow)] border theme-border' : 'text-slate-500 hover:text-slate-300' }} transition-all">Archives_Cibles</a>
                            <a href="{{ route('quizzes.generate') }}" class="px-3 py-1.5 rounded text-[10px] uppercase tracking-widest font-bold {{ request()->routeIs('quizzes.generate') ? 'theme-bg-deep theme-primary shadow-[0_0_10px_var(--primary-glow)] border theme-border' : 'text-slate-500 hover:text-slate-300' }} transition-all">Initialiser_Traque</a>
                            <a href="{{ route('logs') }}" class="px-3 py-1.5 rounded text-[10px] uppercase tracking-widest font-bold {{ request()->routeIs('logs') ? 'theme-bg-deep theme-primary shadow-[0_0_10px_var(--primary-glow)] border theme-border' : 'text-slate-500 hover:text-slate-300' }} transition-all">Historique_Log</a>
                        </div>

                        <!-- Global Score (Compact) -->
                        <div class="flex items-center gap-2 theme-bg-deep border theme-border px-3 py-1.5 rounded shadow-inner">
                            <span class="theme-primary text-[8px] font-black uppercase tracking-tighter opacity-50">Rep</span>
                            <span class="theme-primary text-xs font-black font-mono">{{ number_format(auth()->user()->global_score ?? 0) }}</span>
                        </div>

                        <!-- Operator Hub (Dropdown) -->
                        <div class="relative group">
                            <button id="hubToggle" class="flex items-center gap-3 theme-bg-panel hover:bg-slate-700 px-4 py-2 border theme-border rounded-sm transition-all group-hover:theme-border-primary">
                                <div class="size-6 rounded-sm border theme-border overflow-hidden theme-bg-deep hidden md:block">
                                    <img src="{{ auth()->user()->avatar_url }}" alt="AV" class="w-full h-full object-cover">
                                </div>
                                <span class="text-[10px] uppercase tracking-widest font-black text-slate-300">Operator_Hub</span>
                                <svg class="w-3 h-3 text-slate-500 group-hover:theme-primary transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div id="hubMenu" class="absolute right-0 mt-2 w-56 theme-bg-panel border theme-border rounded shadow-2xl invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all z-50 py-2">
                                <div class="px-4 py-2 border-b theme-border mb-2">
                                    <span class="block text-[8px] uppercase tracking-widest text-slate-500">Status</span>
                                    <span class="block text-xs font-bold theme-primary">{{ auth()->user()->name }} // ACTIVE</span>
                                </div>

                                @php
                                    $pendingDuels = auth()->user()->receivedDuels()->whereNull('defender_score')->where('status', '!=', 'expired')->get();
                                @endphp

                                @if($pendingDuels->count() > 0)
                                    <div class="px-2 mb-2">
                                        <div class="bg-red-950/30 border border-red-500/50 rounded p-2 animate-pulse">
                                            <span class="block text-[8px] uppercase font-black text-red-500 mb-1">DÉFI_INTRUSION_DÉTECTÉ</span>
                                            @foreach($pendingDuels as $pDuel)
                                                <a href="{{ route('duels.play', $pDuel->id) }}" class="block text-[10px] text-white hover:text-red-400 font-bold transition-colors">
                                                    ⚔️ Challenger: {{ $pDuel->challenger->name }}
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-[10px] uppercase tracking-widest font-bold text-slate-300 hover:theme-bg-deep hover:theme-primary transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    Profil_Perso
                                </a>

                                <a href="{{ route('achievements') }}" class="flex items-center gap-3 px-4 py-2 text-[10px] uppercase tracking-widest font-bold text-slate-300 hover:theme-bg-deep hover:theme-primary transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z"></path></svg>
                                    Médailles_Succès
                                </a>

                                <a href="{{ route('leaderboard') }}" class="flex items-center gap-3 px-4 py-2 text-[10px] uppercase tracking-widest font-bold text-slate-300 hover:theme-bg-deep hover:theme-primary transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                    Leaderboard
                                </a>

                                <div class="px-4 py-2 border-t theme-border mt-2 flex items-center justify-between">
                                    <span class="text-[10px] uppercase font-bold text-slate-500">SFX_Engine</span>
                                    <button id="muteToggle" class="text-slate-500 hover:theme-primary transition-colors p-1" title="Mute/Unmute">
                                        <svg id="iconVolumeOn" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"></path></svg>
                                        <svg id="iconVolumeOff" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" opacity=".5"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2"></path></svg>
                                    </button>
                                </div>

                                <form method="POST" action="{{ route('logout') }}" class="px-2 pt-2 border-t theme-border">
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
        const SFX_FILES = {
            click: 'https://assets.mixkit.co/active_storage/sfx/2568/2568-preview.mp3',
            success: 'https://assets.mixkit.co/active_storage/sfx/1435/1435-preview.mp3',
            error: 'https://assets.mixkit.co/active_storage/sfx/951/951-preview.mp3'
        };

        const SFX = {};
        let isMuted = localStorage.getItem('hg_muted') === 'true';
        let audioUnlocked = false;

        // Pré-chargement
        function initAudio() {
            if (audioUnlocked) return;
            Object.keys(SFX_FILES).forEach(key => {
                SFX[key] = new Audio(SFX_FILES[key]);
                SFX[key].volume = 0.2;
                SFX[key].load();
            });
            audioUnlocked = true;
            console.log("Audio Engine Primed");
        }

        const muteToggle = document.getElementById('muteToggle');
        const iconOn = document.getElementById('iconVolumeOn');
        const iconOff = document.getElementById('iconVolumeOff');

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
            initAudio(); // Assure l'initialisation sur interaction
            if (isMuted) return;
            const audio = SFX[sound];
            if (audio) {
                audio.currentTime = 0;
                audio.play().catch(e => console.log('Audio blocked:', e));
            }
        }

        muteToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            initAudio();
            isMuted = !isMuted;
            localStorage.setItem('hg_muted', isMuted);
            updateUI();
            if (!isMuted) playSound('click');
        });

        // Global Click Listener
        document.addEventListener('mousedown', (e) => {
            initAudio();
            const target = e.target.closest('button, a');
            if (target && target.id !== 'muteToggle') {
                playSound('click');
            }
        });

        updateUI();
        window.BugHunterAudio = { play: playSound };
    </script>
</body>
</html>
