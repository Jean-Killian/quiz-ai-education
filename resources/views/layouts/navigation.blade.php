<nav x-data="{ open: false }" class="bg-slate-900 border-b border-green-500/30 font-mono">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('quizzes.index') }}" class="text-green-500 font-black tracking-tighter text-xl">
                        BUG_HUNTER<span class="animate-pulse">_</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('quizzes.index')" :active="request()->routeIs('quizzes.index')" class="text-xs uppercase tracking-widest !text-slate-400 hover:!text-green-400">
                        {{ __('Archives_Cibles') }}
                    </x-nav-link>
                    <x-nav-link :href="route('quizzes.generate')" :active="request()->routeIs('quizzes.generate')" class="text-xs uppercase tracking-widest !text-slate-400 hover:!text-green-400">
                        {{ __('Initialiser_Traque') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6 gap-4">
                <!-- Global Score Display -->
                <div class="px-3 py-1 bg-green-900/20 border border-green-500/50 rounded text-[10px] font-bold text-green-400 tracking-[0.2em] shadow-[0_0_10px_rgba(34,197,94,0.1)]">
                    [ REPUTATION: {{ Auth::user()->global_score }} XP ]
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-slate-700 text-[10px] uppercase tracking-widest font-bold rounded bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-green-400 transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="bg-slate-800 text-slate-300 hover:bg-slate-700 hover:text-green-400 border-b border-slate-700 text-xs">
                            {{ __('Profil_Opérateur') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    onkeydown="if(event.key === 'Enter') { event.preventDefault(); this.closest('form').submit(); }"
                                    class="bg-slate-800 text-red-400 hover:bg-red-900/20 text-xs">
                                {{ __('Déconnexion_Session') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-green-400 hover:bg-slate-800 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-800 border-t border-slate-700">
        <div class="pt-2 pb-3 space-y-1 text-center">
            <x-responsive-nav-link :href="route('quizzes.index')" :active="request()->routeIs('quizzes.index')" class="text-xs uppercase tracking-widest text-slate-300">
                {{ __('Archives_Cibles') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-slate-700 text-center">
            <div class="px-4">
                <div class="font-bold text-green-400 text-xs tracking-widest uppercase">{{ Auth::user()->name }}</div>
                <div class="font-mono text-[10px] text-slate-500">{{ Auth::user()->email }}</div>
                <!-- Mobile Score -->
                <div class="mt-2 text-green-500 font-bold text-[10px] tracking-widest">
                    REPUTATION: {{ Auth::user()->global_score }} XP
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-xs text-slate-400">
                    {{ __('Profil_Opérateur') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            onkeydown="if(event.key === 'Enter') { event.preventDefault(); this.closest('form').submit(); }"
                            class="text-xs text-red-400">
                        {{ __('Déconnexion_Session') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
