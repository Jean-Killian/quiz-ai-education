<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BugHunter AI - Dev Training Simulator</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=fira-code:400,600,700|inter:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['Fira Code', 'monospace'],
                    },
                    colors: {
                        hacker: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .glitch-hover:hover {
            animation: glitch 0.3s cubic-bezier(.25, .46, .45, .94) both infinite;
        }
        @keyframes glitch {
            0% { transform: translate(0) }
            20% { transform: translate(-2px, 2px) }
            40% { transform: translate(-2px, -2px) }
            60% { transform: translate(2px, 2px) }
            80% { transform: translate(2px, -2px) }
            100% { transform: translate(0) }
        }
        body { background-color: #0f172a; color: #cbd5e1; }
    </style>
</head>
<body class="antialiased selection:bg-hacker-500 selection:text-white">
    <div class="relative min-h-screen overflow-hidden">
        <!-- Background Decor -->
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\\'60\\' height=\\'60\\' viewBox=\\'0 0 60 60\\' xmlns=\\'http://www.w3.org/2000/svg\\'%3E%3Cg fill=\\'none\\' fill-rule=\\'evenodd\\'%3E%3Cg fill=\\'%2316a34a\\' fill-opacity=\\'0.05\\'%3E%3Cpath d=\\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')]"></div>
            <div class="absolute top-0 right-0 -mr-48 mt-12 w-96 h-96 bg-hacker-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
            <div class="absolute bottom-0 left-0 -ml-48 mb-12 w-96 h-96 bg-purple-600 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        </div>

        <div class="relative z-10 flex flex-col min-h-screen p-6 sm:p-12">
            <!-- Navbar -->
            <header class="flex justify-between items-center mb-16 border-b border-slate-800 pb-6">
                <div class="flex items-center gap-3">
                    <svg class="h-8 w-8 text-hacker-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    <span class="text-2xl font-mono font-bold tracking-tighter text-white">BugHunter<span class="text-hacker-500">_</span>AI</span>
                </div>
                <nav class="flex gap-4 font-mono text-sm">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/dashboard')); ?>" class="text-slate-300 hover:text-hacker-400 transition flex items-center gap-2">
                            <span>>_ DASHBOARD</span>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-slate-300 hover:text-hacker-400 transition px-4 py-2 border border-transparent">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="text-hacker-400 hover:text-black hover:bg-hacker-400 transition border border-hacker-400 px-4 py-2 rounded-sm shadow-[0_0_10px_rgba(74,222,128,0.2)]">Init_System()</a>
                    <?php endif; ?>
                </nav>
            </header>

            <!-- Hero Section -->
            <main class="flex-grow flex flex-col lg:flex-row items-center justify-between gap-12 mt-8">
                <!-- Text Content -->
                <div class="w-full lg:w-1/2 flex flex-col items-start gap-8">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-hacker-500/30 bg-hacker-500/10 text-hacker-400 text-xs font-mono mb-4">
                        <span class="w-2 h-2 rounded-full bg-hacker-400 animate-pulse"></span>
                        MODULE DE CODE REVIEW ACTIF
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-bold tracking-tight text-white font-sans leading-tight">
                        Apprends à coder.<br/>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-hacker-400 to-teal-300 border-b-4 border-hacker-500">Apprends à débugger.</span>
                    </h1>
                    <p class="text-lg text-slate-400 font-mono leading-relaxed max-w-xl">
                        Aiguise ton oeil de Senior. BugHunter AI génère des snippets de code métier précis contenant de réelles failles ou défauts d'architecture. Ton but ? Les anéantir.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 mt-4 w-full">
                        <a href="<?php echo e(route('register')); ?>" class="inline-flex justify-center items-center gap-2 bg-hacker-600 hover:bg-hacker-500 text-white font-mono font-bold uppercase tracking-widest px-8 py-4 rounded-sm transition shadow-[0_0_20px_rgba(22,163,74,0.4)] glitch-hover">
                            > Démarrer la Traque
                        </a>
                        <a href="#features" class="inline-flex justify-center items-center gap-2 border border-slate-700 bg-slate-800 hover:bg-slate-700 text-slate-300 font-mono focus:ring-4 focus:ring-slate-800 px-8 py-4 rounded-sm transition">
                            Lire les Logs
                        </a>
                    </div>
                </div>

                <!-- Hero Graphic (Terminal Fake UI) -->
                <div class="w-full lg:w-1/2 relative lg:mt-0 mt-12 group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-hacker-600 to-teal-500 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                    <div class="relative bg-slate-900 border border-slate-700 rounded-lg overflow-hidden shadow-2xl">
                        <!-- Terminal Header -->
                        <div class="bg-slate-800 px-4 py-3 border-b border-slate-700 flex items-center justify-between">
                            <div class="flex gap-2">
                                <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                <div class="w-3 h-3 rounded-full bg-green-500"></div>
                            </div>
                            <span class="text-xs font-mono text-slate-400">root@bughunter: ~</span>
                        </div>
                        <!-- Terminal Code -->
                        <div class="p-6 text-sm font-mono leading-relaxed overflow-hidden">
                            <div class="mb-4">
                                <span class="text-hacker-400">➜</span> <span class="text-blue-400">~</span> <span class="text-white">./hunter_ai build --lang=PHP --difficulty=Senior</span>
                            </div>
                            <div class="text-slate-400 mb-2">Analyzing target patterns... [OK]</div>
                            <div class="text-slate-400 mb-4">Generating insecure snippet... [OK]</div>
                            <div class="bg-slate-950 p-4 rounded border border-red-900/50 text-slate-300 my-4 shadow-inner">
                                <span class="text-purple-400">public function</span> <span class="text-blue-300">getUserData</span>(<span class="text-hacker-300">$request</span>) {<br/>
                                &nbsp;&nbsp;<span class="text-gray-500">// Vulnerability detected</span><br/>
                                &nbsp;&nbsp;<span class="text-hacker-300">$id</span> = <span class="text-hacker-300">$_GET</span>[<span class="text-yellow-200">'id'</span>];<br/>
                                &nbsp;&nbsp;<span class="text-purple-400">return</span> <span class="text-hacker-300">DB</span>::<span class="text-blue-300">select</span>(<span class="text-yellow-200">"SELECT * FROM users WHERE id = $id"</span>);<br/>
                                }
                            </div>
                            <div class="text-red-400 animate-pulse mt-2">> WAITING FOR PATCH SELECTION...</div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/welcome.blade.php ENDPATH**/ ?>