<x-layout>
  <div class="w-[80%] float-end mr-10 text-white">
      <h2 class="text-4xl text-white my-10">Messages</h2>
      <div class="flex flex-wrap gap-5 max-w-6xl">
          @foreach ($conversations as $conversation)
              <a href="{{ route('messages.show', $conversation->id) }}" class="w-[300px] h-auto bg-slate-500 rounded-xl flex flex-col gap-9 items-center justify-center p-10">
                  <p>Conversation with {{ $conversation->participants->where('user_id', '!=', Auth::id())->first()->user->name }}</p>
              </a>
          @endforeach
      </div>
  </div>
</x-layout>