<x-layout>
    <div class="container flex flex-col justify-center h-screen items-center mx-auto p-4" x-data="quiz()">
        @if (session('success'))
            <x-empty>
                {{ session('success') }}
            </x-empty>
        @endif
        

        <h1 class="text-5xl font-bold mb-10 text-white">{{ $quiz->title }}</h1>

        <!-- Quiz Container -->
        <div class="bg-slate-600 text-white w-full p-6 rounded-lg shadow-md">
            <!-- Question Navigation -->

            <!-- Question -->
            <div x-show="currentQuestionIndex >= 0">
                <p class="text-3xl text-center font-semibold mb-4" x-text="questions[currentQuestionIndex].question"></p>

                <!-- Answers -->
                <div class="grid grid-cols-2 gap-4">

                    <template x-for="(option, index) in questions[currentQuestionIndex].options" :key="index">
                        <div class="w-full mb-4"> <!-- Full-width container for each option -->
                            <input
                                type="radio"
                                x-model="answers[questions[currentQuestionIndex].id]"
                                :name="'answers[' + questions[currentQuestionIndex].id + ']'"
                                :value="option.key"
                                :id="'option-' + questions[currentQuestionIndex].id + '-' + index"
                                class="hidden"
                            >
                            <label 
                                :for="'option-' + questions[currentQuestionIndex].id + '-' + index"
                                :class="{
                                    'bg-yellow-500 hover:bg-yellow-600': option.key === 'A' || option.key === 'True',
                                    'bg-blue-500 hover:bg-blue-600': option.key === 'B' || option.key === 'False',
                                    'bg-green-500 hover:bg-green-600': option.key.trim().toUpperCase() === 'C', // Fix for Option C
                                    'bg-red-500 hover:bg-red-600': option.key === 'D',
                                    'ring-4 ring-offset-2 ring-white': answers[questions[currentQuestionIndex].id] === option.key,
                                    
                                }"
                                class="flex items-center justify-center  h-20 text-white text-2xl font-bold rounded-lg cursor-pointer transition-colors duration-200"
                            >
                                <span x-text="option.value" class="text-center"></span>
                            </label>
                        </div>
                    </template>
                </div>
            </div>
            <div class="flex justify-between mt-6 gap-5" >
                <button x-on:click="previousQuestion" x-bind:disabled="currentQuestionIndex === 0"
                    class="bg-slate-800 shadow-md font-bold text-white px-4 py-2 rounded w-full hover:bg-gray-400 disabled:opacity-10 disabled:cursor-not-allowed">
                    Mbrapa
                </button>
                <button x-on:click="nextQuestion" x-bind:disabled="currentQuestionIndex === questions.length - 1"
                    class="bg-slate-800 shadow-md font-bold text-white px-4 py-2 rounded w-full hover:bg-gray-400 disabled:opacity-10 disabled:cursor-not-allowed">
                    Tjetra
                </button>
            </div>


            <!-- Submit Button -->
            <div class="mt-6 " x-show="currentQuestionIndex === questions.length - 1">
                <button type="button" x-on:click="submitQuiz"
                    class="bg-blue-500 w-full text-white px-4 py-2 rounded hover:bg-blue-600">
                    Paraqit
                </button>
            </div>
        </div>
    </div>

    <!-- Alpine.js Script -->
    <script>
        function quiz() {
            return {
                questions: @json($quiz->questions),
                currentQuestionIndex: 0,
                answers: {},

                // Navigate to the previous question
                previousQuestion() {
                    if (this.currentQuestionIndex > 0) {
                        this.currentQuestionIndex--;
                    }
                },

                // Navigate to the next question
                nextQuestion() {
                    if (this.currentQuestionIndex < this.questions.length - 1) {
                        this.currentQuestionIndex++;
                    }
                },

                // Submit the quiz
                submitQuiz() {
                    // Submit the form programmatically
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('quizzes.submit', $quiz) }}";

                    // Add CSRF token
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = "{{ csrf_token() }}";
                    form.appendChild(csrfToken);

                    // Add answers
                    Object.entries(this.answers).forEach(([questionId, answer]) => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = `answers[${questionId}]`;
                        input.value = answer;
                        form.appendChild(input);
                    });

                    // Submit the form
                    document.body.appendChild(form);
                    form.submit();
                },
            };
        }
    </script>
</x-layout>
