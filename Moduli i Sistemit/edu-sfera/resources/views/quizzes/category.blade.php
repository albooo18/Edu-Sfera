<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-white">{{ $category }} Kuizzet</h1>
        
        <!-- Check if there are quizzes -->
        @if ($quizzes->isEmpty())
            <p class="text-white">Ska Kuize per kete kategori.</p>
        @else
            <!-- Grid for quizzes -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($quizzes as $quiz)
                    <a href="{{ route('quizzes.show', $quiz) }}" class="p-6 rounded-lg shadow-md hover:shadow-xl bg-slate-600 transition-shadow text-white ">
                        <h2 class="text-xl font-semibold">{{ $quiz->title }}</h2>
                        <p class="text-gray-300">{{ Str::limit($quiz->description, 100) }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
  </x-layout>