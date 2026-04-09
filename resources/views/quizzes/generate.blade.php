<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Générer un quiz par IA
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('quizzes.generate.post') }}" method="POST" onsubmit="showLoader()">
                        @csrf
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Sujet du quiz</label>
                            <input type="text" name="subject" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full py-2 px-3 text-gray-700" placeholder="Ex: Laravel Eloquent, VueJS 3, CSS Flexbox...">
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de questions</label>
                            <input type="number" name="count" min="1" max="10" value="3" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full py-2 px-3 text-gray-700">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nombre de propositions par question</label>
                            <input type="number" name="answers" min="2" max="6" value="4" required class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full py-2 px-3 text-gray-700">
                        </div>
                        <div class="flex items-center justify-between">
                            <a href="{{ route('quizzes.index') }}" class="text-sm border-gray-300 text-gray-500 hover:text-gray-900">Annuler</a>
                            <button type="submit" id="submit-btn" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded transition flex items-center gap-2">
                                <span id="btn-text">✨ Générer par IA</span>
                                <svg id="loading-spinner" class="animate-spin hidden h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            document.getElementById('btn-text').innerText = "Génération en cours...";
            document.getElementById('loading-spinner').classList.remove('hidden');
        }
    </script>
</x-app-layout>
