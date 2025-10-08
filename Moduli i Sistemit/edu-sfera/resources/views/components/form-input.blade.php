
    <div class="mb-4 w-full">
        <label for="default-input"
            class="w-full block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $slot }}</label>
        <input {{ $attributes }} required
            class=" bg-gray-500 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <x-form-error name="error" />
    </div>
