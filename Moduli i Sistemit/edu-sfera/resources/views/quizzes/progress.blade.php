<x-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-white">Progressi Juaj i kuizeve</h1>

        <!-- Progress Table -->
        <div class="bg-slate-600 text-white p-6 rounded-lg shadow-md">
            @if ($progress->isEmpty())
                <p class="text-center text-gray-300">Ju nuk keni kompletuar asnje kuiz.</p>
            @else
                <table class="w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-500">
                            <th class="py-2">Titulli Kuizit</th>
                            <th class="py-2">Rezultati</th>
                            <th class="py-2">Perfunduar me</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($progress as $result)
                            <tr class="border-b border-gray-700 hover:bg-slate-700 transition-colors">
                                <td class="py-3">{{ $result->quiz->title }}</td>
                                <td class="py-3">{{ $result->score }} / {{ $result->quiz->questions->count() }}</td>
                                <td class="py-3">{{ $result->completed_at->format('M d, Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-layout>