<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl theme-primary leading-tight font-mono">
            > INITIATING_HOSTILE_TAKEOVER // TARGET: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12 theme-bg-deep min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="theme-bg-panel theme-border theme-glow border-2 rounded-lg p-8">
                <div class="flex items-center gap-6 mb-8 border-b theme-border pb-6">
                    <div class="size-20 rounded border-2 theme-border-primary overflow-hidden shadow-[0_0_20px_var(--primary-glow)]">
                        <img src="{{ $user->avatar_url }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h3 class="text-2xl font-black text-white uppercase tracking-widest">Défier Opérateur_Alias</h3>
                        <p class="theme-primary font-mono text-sm opacity-70">Cible : {{ $user->name }} // Reputation : {{ number_format($user->global_score) }} XP</p>
                    </div>
                </div>

                <form action="{{ route('duels.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="defender_id" value="{{ $user->id }}">

                    <div class="mb-8">
                        <label class="block theme-primary text-xs font-black uppercase tracking-[0.2em] mb-4">Sélectionner le Terrain de Combat (Mission) :</label>
                        <div class="grid grid-cols-1 gap-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($quizzes as $quiz)
                                <label class="relative group cursor-pointer">
                                    <input type="radio" name="quiz_id" value="{{ $quiz->id }}" class="peer hidden" required>
                                    <div class="p-4 theme-bg-deep border theme-border rounded group-hover:theme-border-primary transition-all peer-checked:theme-border-primary peer-checked:bg-white/5">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <div class="text-white font-bold text-sm uppercase">{{ $quiz->title }}</div>
                                                <div class="text-[10px] text-slate-500">{{ $quiz->description }}</div>
                                            </div>
                                            <div class="text-[10px] font-black theme-primary px-2 border theme-border-primary rounded">
                                                {{ $quiz->difficulty }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="absolute inset-y-0 left-0 w-1 theme-bg-deep group-hover:bg-green-500 peer-checked:bg-green-500 transition-all"></div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('leaderboard') }}" class="text-slate-500 hover:text-white text-[10px] uppercase font-bold tracking-widest transition-colors">
                            [ Aband_Mission ]
                        </a>
                        <button type="submit" class="px-8 py-3 theme-bg-deep border-2 theme-border-primary theme-primary font-black uppercase tracking-widest hover:theme-bg-panel transition-all shadow-[0_0_20px_var(--primary-glow)]">
                            LANCER_L_ATTAQUE_()
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(0,0,0,0.2); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgb(var(--primary)); border-radius: 10px; }
    </style>
</x-app-layout>
