<x-layout>
    <div class="w-[80%] float-end mr-10 text-white">
        <h2 class="text-4xl text-white my-10">Messages</h2>
        <div class="flex flex-col gap-5 max-w-6xl">
            @foreach ($conversation->messages as $message)
                <div class="w-fit bg-slate-500 rounded-xl flex flex-col gap-9 items-center justify-center p-10">
                    <p>{{ $message->sender->name }}: {{ $message->message }}</p>
                </div>
            @endforeach
            <form action="{{ route('messages.store', $conversation->id) }}" method="POST">
                @csrf
                <input type="text" name="message" placeholder="Type a message">
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</x-layout>