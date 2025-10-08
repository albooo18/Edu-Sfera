@php
    $gradients = [
        'from-red-500 to-yellow-500',
        'from-blue-500 to-green-500',
        'from-purple-500 to-pink-500',
        'from-cyan-500 to-indigo-500',
        'from-gray-700 to-gray-900',
    ];
    $randomGradient = $gradients[array_rand($gradients)];
@endphp

<x-layout>
  <div class="w-screen flex justify-center text-white">
      <div class="h-[300px] w-[100vw] z-[-2] absolute bg-gradient-to-r {{ $randomGradient }}"></div>

      <div class="w-full mt-[150px] h-fit max-w-4xl bg-slate-600 rounded-xl p-8 flex flex-col items-center justify-center shadow-center shadow-black/50 relative group">
          <button id="edit-btn" title="Edit" class="absolute right-5 top-5 text-gray-300/70 text-xl hover:text-gray-50 hover:scale-125 transition-all invisible group-hover:visible">
              <div id="edit-icon">
                  <i class="fas fa-pencil-alt"></i>
              </div>
              <div id="edit-save" class="hidden">
                  <i class="fas fa-check"></i>
              </div>
          </button>

          <div class="relative">
              <img src="{{ asset($user->img) }}" id="profile-image" class="rounded-full object-fit border-dashed w-[250px] h-[250px]" height="250px" width="250px" alt="Profile Image" contenteditable="false">
              <input type="file" id="image-upload" class="absolute inset-0 opacity-0 cursor-pointer hidden" onchange="previewImage(event)" />
          </div>

          <div class="flex flex-col w-full items-center justify-center gap-8">
              <div class="flex">
                  <h1 id="name" class="text-5xl py-5 px-2 font-extrabold rounded-xl capitalize" contenteditable="false">{{ $user->name }}</h1>
                  <h1 id="surname" class="text-5xl py-5 px-2 font-extrabold rounded-xl capitalize" contenteditable="false">{{ $user->surname }}</h1>
              </div>

              <x-split-style>
                  <x-slot:heading-1>
                      <i class="fas fa-graduation-cap"></i>
                      <div id="uni" class="text-3xl rounded-xl p-2" contenteditable="false">
                          <h5 id="uni-text">{{ $user->uni }}</h5>
                          <select id="uni-select" class="hidden text-3xl rounded-xl p-2 bg-slate-600">
                              <option value="UKZ" {{ $user->uni == 'UKZ' ? 'selected' : '' }}>UKZ</option>
                              <option value="UP" {{ $user->uni == 'UP' ? 'selected' : '' }}>UP</option>
                              <option value="USHAF" {{ $user->uni == 'USHAF' ? 'selected' : '' }}>USHAF</option>
                          </select>
                      </div>
                  </x-slot:heading-1>
                  <x-slot:heading-2>
                      <i class="fas fa-map-pin"></i>
                      <h5 id="location" class="text-3xl rounded-xl p-2" contenteditable="false">{{ $user->location }}</h5>
                  </x-slot:heading-2>
              </x-split-style>

              <div class="mx-10 h-[1px] w-96 bg-gray-50/30"></div>
              <div class="flex gap-10">
                  <div class="flex flex-col items-center justify-center">
                      <h3 class="font-bold text-7xl">{{ $friendCount }}</h3>
                      <span>Shoket</span>
                  </div>
                  <div class="flex flex-col items-center justify-center">
                      <h3 class="font-bold text-7xl">{{ $postCount }}</h3>
                      <span>Postet</span>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Display User's Posts -->
  <div class="w-screen flex justify-center mt-8">
      <div class="w-full max-w-4xl">
          <h2 class="text-2xl font-bold mb-4">Postet</h2>
          @if ($posts->count() > 0)
              @foreach ($posts as $post)
                  <div class="bg-slate-600 p-4 rounded-md shadow-md mb-4">
                      <h3 class="text-xl font-semibold">{{ $post->title }}</h3>
                      <p class="text-gray-300">{{ Str::limit($post->body, 200) }}</p>
                      <div class="mt-2">
                          @foreach ($post->tags as $tag)
                              <span class="bg-blue-500 text-white text-sm px-2 py-1 rounded-full">{{ $tag->name }}</span>
                          @endforeach
                      </div>
                  </div>
              @endforeach
              {{ $posts->links() }} <!-- Pagination Links -->
          @else
              <p class="text-gray-300">Skeni Postuar.</p>
          @endif
      </div>
  </div>

  <!-- Display User's Friends -->
  <div class="w-screen flex justify-center mt-8">
      <div class="w-full max-w-4xl">
          <h2 class="text-2xl font-bold mb-4">Shoket</h2>
          @if ($friends->count() > 0)
              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                  @foreach ($friends as $friend)
                      <div class="bg-slate-600 p-4 rounded-md shadow-md">
                          <div class="flex items-center">
                              <img src="{{ asset($friend->img) }}" class="w-10 h-10 rounded-full mr-3" alt="{{ $friend->name }}">
                              <div>
                                  <h3 class="text-lg font-semibold">{{ $friend->name }} {{ $friend->surname }}</h3>
                                  <p class="text-sm text-gray-300">{{ $friend->uni }}</p>
                              </div>
                          </div>
                          <form action="{{ route('profile.remove-friend', $friend->id) }}" method="POST" class="mt-2">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                  Fshi shokun
                              </button>
                          </form>
                      </div>
                  @endforeach
              </div>
          @else
              <p class="text-gray-300">Skeni shoqeri.</p>
          @endif
      </div>
  </div>

  <script>
      const editBtn = document.getElementById('edit-btn');
      const editIcon = document.getElementById('edit-icon');
      const editSaveIcon = document.getElementById('edit-save');
      const editableFields = document.querySelectorAll('[contenteditable]');
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

      const addEditableBorder = () => {
          editableFields.forEach(field => {
              field.classList.add('border-2','border-dashed', 'border-gray-500', 'm-2');
          });
      };

      const removeEditableBorder = () => {
          editableFields.forEach(field => {
              field.classList.remove('border-2','border-dashed', 'border-gray-500', 'm-2');
          });
      };

      editBtn.addEventListener('click', async () => {
          if (editSaveIcon.classList.contains('hidden')) {
              editableFields.forEach(field => {
                  field.contentEditable = field.contentEditable === 'true' ? 'false' : 'true';
              });

              addEditableBorder();

              document.getElementById('uni-text').classList.add('hidden');
              document.getElementById('uni-select').classList.remove('hidden');
              document.getElementById('image-upload').classList.remove('hidden');


              editIcon.classList.toggle('hidden');
              editSaveIcon.classList.toggle('hidden');
          } else {
              await updateProfile();

              const selectedUni = document.getElementById('uni-select').value;
              document.getElementById('uni-text').textContent = selectedUni;
              document.getElementById('uni-text').classList.remove('hidden');
              document.getElementById('uni-select').classList.add('hidden');
              document.getElementById('image-upload').classList.add('hidden');


              editableFields.forEach(field => {
                  field.contentEditable = 'false';
              });

              removeEditableBorder();

              editIcon.classList.toggle('hidden');
              editSaveIcon.classList.toggle('hidden');
          }
      });

      const updateProfile = async () => {
          const data = new FormData();
          const image = document.getElementById('image-upload').files[0];

          data.append('name', document.getElementById('name').innerText);
          data.append('surname', document.getElementById('surname').innerText);
          data.append('uni', document.getElementById('uni-select').value); 
          data.append('location', document.getElementById('location').innerText);
          if (image) {
              data.append('image', image);  
          }

          const response = await fetch('/update-profile', {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': csrfToken
              },
              body: data
          });

          if (response.ok) {
              console.log('Profile updated');
          } else {
              console.log('Error updating profile');
          }
      };

      const previewImage = (event) => {
          const file = event.target.files[0];
          const reader = new FileReader();

          reader.onloadend = () => {
              const imageElement = document.getElementById('profile-image');
              imageElement.src = reader.result;
          };

          if (file) {
              reader.readAsDataURL(file);
          }
      };
  </script>
</x-layout>