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

                    <div class="flex items-center space-x-6">
                        <div class="hidden md:flex flex-col items-end">
                            <span class="text-green-500 text-[10px] leading-none uppercase tracking-widest font-bold">Session active</span>
                            <span class="text-slate-400 text-xs">{{ auth()->user()->name ?? 'Opérateur' }}</span>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="border border-red-900/50 bg-red-950/20 hover:bg-red-600 hover:text-white text-red-400 px-3 py-1 text-[10px] font-bold uppercase tracking-widest transition-all rounded-sm">
                                [ Terminate ]
                            </button>
                        </form>
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
</body>
</html>
