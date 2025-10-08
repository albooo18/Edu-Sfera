<x-layout>
  <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4 text-white">Modifiko Postin</h1>

      <form action="{{ route('posts.update', $post) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="form-group mb-4">
              <label for="title" class="block text-sm font-medium text-gray-700">Titulli</label>
              <input type="text" name="title" id="title" class="outline-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border-2 border-gray-300 focus:ring-blue-800 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-800 dark:focus:border-blue-800 shadow-2xl" value="{{ old('title', $post->title) }}" required>
          </div>

          <div class="form-group mb-4">
              <label for="body" class="block text-sm font-medium text-gray-700">Pershkrimi</label>
              <textarea name="body" id="body" rows="5" class=" outline-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border-2 border-gray-300 focus:ring-blue-800 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-800 dark:focus:border-blue-800 shadow-2xl" required>{{ old('body', $post->body) }}</textarea>
          </div>

          <div class="form-group mb-4">
              <label for="tags" class="block text-sm font-medium text-gray-700">Tagjet (Te ndara me presje)</label>
              <input type="text" name="tags" id="tags" class="outline-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border-2 border-gray-300 focus:ring-blue-800 focus:border-blue-800 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-800 dark:focus:border-blue-800 shadow-2xl" value="{{ old('tags', $post->tags->pluck('name')->implode(',')) }}" placeholder="Tagu1, Tagu2, Tagu3">
          </div>

          <button type="submit" class="px-4 py-2 bg-slate-600 text-white rounded hover:bg-slate-700 font-semibold transition-all duration-150">Modifiko</button>
      </form>
  </div>
</x-layout>