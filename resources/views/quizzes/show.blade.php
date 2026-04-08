<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p class="mb-6 text-gray-600">{{ $quiz->description }}</p>

                    <form action="{{ route('quizzes.submit', $quiz->id) }}" method="POST">
                        @csrf

                        @foreach($quiz->questions as $index => $question)
                            <div class="mb-8 border-b pb-4">
                                <p class="font-bold mb-3">{{ $index + 1 }}. {{ $question->question_text }}</p>
                                
                                <ul class="space-y-2">
                                    @foreach($question->answers as $answer)
                                        <li>
                                            <label class="flex items-center space-x-2 cursor-pointer">
                                                <input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" class="border-gray-300 text-blue-600 focus:ring-blue-500" required>
                                                <span>{{ $answer->answer_text }}</span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="px-6 py-2 bg-green-500 text-white font-bold rounded hover:bg-green-600 transition">
                                Terminer le Quiz
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
