<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Quiz') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Quiz disponibles</h3>
                        <a href="{{ route('quizzes.generate') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded text-sm transition">
                            ✨ Générer par IA
                        </a>
                    </div>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($quizzes->isEmpty())
                        <p>Aucun quiz n'est disponible pour le moment.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach($quizzes as $quiz)
                                <li class="border p-4 rounded bg-gray-50 flex justify-between items-center">
                                    <div>
                                        <div class="font-semibold text-lg">{{ $quiz->title }}</div>
                                        <div class="text-sm text-gray-600">{{ $quiz->description }}</div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        @if(isset($userQuizzes[$quiz->id]))
                                            <span class="text-sm font-medium text-green-600">
                                                Dernier score : {{ $userQuizzes[$quiz->id]->pivot->score }} / {{ $quiz->questions()->count() }}
                                            </span>
                                        @endif
                                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                            Commencer
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
