<button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="relative" type="button"><x-sidebar-link><i
            class="fa-regular fa-square-caret-down "></i></x-sidebar-link>
    <div id="dropdown"
        class="z-60 hidden absolute left-0 bottom-[101%] bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700">
        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
            <li>
                <a href="/profile"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-30">Profili</a>
            </li>
            <li>

                <form action="/logout" method="POST">
                    @csrf

                    <input type="submit" value="Qkyqu" class="cursor-pointer block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white w-30"/>
                </form>
            </li>

        </ul>
    </div>

</button>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownButton = document.getElementById("dropdownDefaultButton");
        const dropdownMenu = document.getElementById("dropdown");

        dropdownButton.addEventListener("click", function() {
            dropdownMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", function(event) {
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add("hidden");
            }
        });
    });
</script>
