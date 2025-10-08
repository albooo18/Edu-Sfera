@php
    $backgroundImages = [
        'images/marketing.jpg',
        'images/banks.jpg',
        'images/law.jpg',
        'images/computer.jpg',
        'images/economy.jpg',
        'images/education.jpg',
    ];
@endphp

<x-layout>
    <div class="container mx-auto p-4 h-screen w-full flex flex-col justify-between">
        <div class="">
            <h1 class="text-3xl font-bold mb-6 text-white">Kuizet</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('quizzes.category', $category) }}"
                        class="flex shadow-center justify-center items-center h-[300px] rounded-lg hover:shadow-lg relative overflow-hidden transition-shadow"
                        style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.7)), url('{{ asset($backgroundImages[$loop->index % count($backgroundImages)]) }}'); background-size: cover; background-position: center;">
                        <h2 class="text-5xl font-semibold text-white z-10">{{ $category }}</h2>
                    </a>
                @endforeach
            </div>
        </div>
        <a href="{{ route('quizzes.progress') }}"
            class="w-[400px] text-center mx-auto bg-slate-800 font-bold shadow-center text-white px-6 py-4 rounded hover:bg-slate-900 duration-200">
            Shiko Progressin
        </a>
    </div>
</x-layout>
