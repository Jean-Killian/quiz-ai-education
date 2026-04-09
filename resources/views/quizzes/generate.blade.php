<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-green-400 leading-tight font-mono">
            > Initialiser une Traque (Générateur)
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700">
                <div class="p-6 text-gray-300">
                    
                    @if(session('error'))
                        <div class="bg-red-900/50 border border-red-500 text-red-400 px-4 py-3 rounded relative mb-4 font-mono">
                            [ERROR] {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('quizzes.generate.post') }}" method="POST" onsubmit="showLoader()">
                        @csrf
                        <div class="mb-5">
                            <label class="block text-green-400 text-sm font-bold mb-2 font-mono">> CIBLER LE VECTEUR (LANGAGE)</label>
                            <select name="subject" required class="bg-slate-900 border-gray-600 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm w-full py-2 px-3 text-green-300 font-mono">
                                <option value="PHP">PHP (Backend)</option>
                                <option value="JavaScript">JavaScript (Fullstack)</option>
                                <option value="TypeScript">TypeScript (Typed JS)</option>
                                <option value="Python">Python (Scripting/AI)</option>
                                <option value="Java">Java (Enterprise)</option>
                                <option value="C#">C# (DotNet)</option>
                                <option value="SQL">SQL (Database/Security)</option>
                                <option value="React">React (Frontend Framework)</option>
                                <option value="Go">Go (Cloud Native)</option>
                                <option value="Rust">Rust (System Security)</option>
                            </select>
                        </div>
                        
                        <div class="mb-5">
                            <label class="block text-green-400 text-sm font-bold mb-2 font-mono">> DIFFICULTÉ</label>
                            <select name="difficulty" class="bg-slate-900 border-gray-600 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm w-full py-2 px-3 text-green-300 font-mono">
                                <option value="Junior">Junior (Syntaxe & Typo)</option>
                                <option value="Medior" selected>Medior (Logique & Structure)</option>
                                <option value="Senior">Senior (Architecture & Sécurité)</option>
                            </select>
                        </div>

                        <div class="flex gap-4">
                            <div class="mb-5 w-1/2">
                                <label class="block text-gray-500 text-sm font-bold mb-2">NOMBRE DE BUGS</label>
                                <input type="number" name="count" min="1" max="10" value="3" required class="bg-slate-900 border-gray-600 rounded-md shadow-sm w-full py-2 px-3 text-gray-300">
                            </div>
                            <div class="mb-6 w-1/2">
                                <label class="block text-gray-500 text-sm font-bold mb-2">PATCHES PROPOSÉS</label>
                                <input type="number" name="answers" min="2" max="6" value="4" required class="bg-slate-900 border-gray-600 rounded-md shadow-sm w-full py-2 px-3 text-gray-300">
                            </div>
                        </div>

                        <div class="flex items-center justify-between border-t border-gray-700 pt-5 mt-2">
                            <a href="{{ route('quizzes.index') }}" class="text-sm text-gray-500 hover:text-red-400 font-mono">[ ABORT ]</a>
                            <button type="submit" id="submit-btn" class="bg-green-600 hover:bg-green-500 text-black font-bold py-2 px-6 rounded transition flex items-center gap-2 font-mono uppercase tracking-widest shadow-[0_0_15px_rgba(34,197,94,0.3)]">
                                <span id="btn-text">Initialiser l'IA</span>
                                <svg id="loading-spinner" class="animate-spin hidden h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showLoader() {
            var btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.classList.add('opacity-50', 'cursor-not-allowed');
            document.getElementById('btn-text').innerText = "CALCULATING...";
            document.getElementById('loading-spinner').classList.remove('hidden');
        }
    </script>
</x-app-layout>
