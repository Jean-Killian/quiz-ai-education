<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Résultats de : {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center py-10">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-2xl font-bold mb-4">Votre Score</h3>
                    
                    <div class="text-6xl font-extrabold text-blue-600 mb-6">
                        {{ $score }} <span class="text-3xl text-gray-400">/ {{ $totalQuestions }}</span>
                    </div>

                    <p class="mb-8 text-gray-600">
                        @if($score == $totalQuestions)
                            Félicitations, c'est un sans-faute !
                        @elseif($score >= $totalQuestions / 2)
                            Pas mal du tout ! Encore un effort !
                        @else
                            Il va falloir réviser un peu...
                        @endif
                    </p>

                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('quizzes.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition">
                            Retour à la liste
                        </a>
                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            Refaire le Quiz
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
