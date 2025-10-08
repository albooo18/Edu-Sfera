@props(['name' => 'uni'])

  <label for="{{ $slot }}" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selekto opsion</label>
  <select id="{{ $slot }}" name="{{ $name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
    <option selected>{{ $slot }}</option>
    <option value="UKZ">Universiteti Kadri Zeka</option>
    <option value="UP">Universiteti Hasan Prishtina</option>
    <option value="USHAF">Universiteti i Shkencave te Aplikuara Ferizaj</option>
  </select>
