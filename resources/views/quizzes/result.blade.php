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
                        <a href="{{ route('quizzes.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition font-medium border border-gray-300">
                            Retour à la liste
                        </a>
                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition font-bold shadow">
                            Refaire le Quiz
                        </a>
                    </div>
                </div>
            </div>

            @if(session()->has('user_answers'))
                <div class="mt-8 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h4 class="text-2xl font-black mb-6 text-gray-800 border-b pb-4">Correction détaillée</h4>
                    <div class="space-y-8">
                        @foreach($quiz->questions as $index => $question)
                            <div>
                                <p class="font-bold text-lg text-gray-900 mb-3">
                                    <span class="text-indigo-600 mr-1">Q{{ $index + 1 }}.</span> {{ $question->question_text }}
                                </p>
                                <div class="space-y-2 pl-6 border-l-4 border-indigo-100">
                                    @php 
                                        $userAnswerId = session('user_answers')[$question->id] ?? null; 
                                    @endphp
                                    @foreach($question->answers as $answer)
                                        @php
                                            $isUserChoice = ((string)$answer->id === (string)$userAnswerId);
                                            $bgClass = 'bg-gray-50 border-gray-200 text-gray-600';
                                            
                                            // Highlight logic
                                            if ($answer->is_correct) {
                                                $bgClass = 'bg-green-100 border-green-500 text-green-900 font-bold';
                                            } elseif ($isUserChoice && !$answer->is_correct) {
                                                $bgClass = 'bg-red-100 border-red-400 text-red-900 line-through opacity-80';
                                            }
                                        @endphp
                                        <div class="p-3 border rounded-md flex justify-between items-center {{ $bgClass }}">
                                            <span>{{ $answer->answer_text }}</span>
                                            <div class="flex items-center space-x-2 text-sm">
                                                @if($isUserChoice) <span class="bg-white px-2 py-1 rounded text-xs font-semibold shadow-sm text-gray-700">Sélectionné</span> @endif
                                                @if($answer->is_correct) <span class="text-green-600 text-lg">✅</span> @endif
                                                @if($isUserChoice && !$answer->is_correct) <span class="text-red-500 text-lg">❌</span> @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
