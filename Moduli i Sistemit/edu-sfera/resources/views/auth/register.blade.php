<x-layout>
    <div class="flex w-full h-screen items-center justify-center flex-col">
        <h1 class="m-10 text-4xl font-bold text-white">Regjistrohuni</h1>
        <div class="w-[500px] p-5 min-w-lg border-2 rounded-xl shadow-md shadow-gray-400/50">

            <form method="POST" action="register" enctype="multipart/form-data">
                @csrf

                <div class="flex gap-3">
                    <x-form-input type="text" name="name">Emri</x-form-input>
                    <x-form-input type="text" name="surname">Mbiemri</x-form-input>
                </div>

                <x-form-input type="email" name="email">Email</x-form-input>
                <x-form-input type="text" name="location">Vendbanimi</x-form-input>
                <div class="flex gap-3">

                    <x-form-input type="password" name="password">Password</x-form-input>
                    <x-form-input type="password" name="password_confirmation">Konfirmo Passwordin</x-form-input>
                </div>
                <x-form-select name='uni'>Universiteti</x-form-select>
                <div class="flex items-center justify-center w-full my-2" id="image-upload-div">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-15 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50  dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click
                                    to upload</span></p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF
                            </p>
                        </div>
                        <input id="dropzone-file" type="file" name="img" class="hidden"
                            onchange="showFileName(this);" />
                    </label>
                </div>

                <script>
                    function showFileName(input) {
                        const fileName = input.files[0].name;
                        document.getElementById('image-upload-div').style.display = 'none';
                        document.getElementById('file-name-div').innerHTML = `Selected file: <h4 class="text-white">${fileName}</h4>`;
                    }
                </script>


                <div id="file-name-div" class="mt-2 text-sm text-gray-500 dark:text-gray-400"></div> <x-form-button
                    class="w-full" value='Register'>Regjistrohu</x-form-button>
                <a href="/login" class="underline text-white">Jeni Regjistruar? Klikoni Ketu</a>
            </form>
        </div>
    </div>
</x-layout>
