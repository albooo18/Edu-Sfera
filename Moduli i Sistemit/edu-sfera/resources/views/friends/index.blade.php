<x-layout>
    <div class="w-[80%] float-end mr-10 text-white" x-data="{ tab: 'all' }">
        <h2 class="text-4xl text-white my-10">Shoket</h2>

        <div class="flex gap-5 mb-5 border-b-2 border-gray-400/50 text-slate-400">
            <a href="#" @click.prevent="tab = 'all'" :class="{ 'font-bold': tab === 'all' }">Te Gjithe</a>
            <a href="#" @click.prevent="tab = 'sent'" :class="{ 'font-bold': tab === 'sent' }">Dergesat</a>
            <a href="#" @click.prevent="tab = 'received'" :class="{ 'font-bold': tab === 'received' }">Kerkesat</a>
        </div>

        <div x-show="tab === 'all'">
            <h3 class="my-10">Te Gjithe Perdoruesit</h3>
            <div class="flex flex-wrap gap-5 max-w-7xl">
                @php
                    $noUsersFound = true;
                @endphp

                @foreach ($users as $user)
                    @php
                        $isFriend = \App\Models\FriendRequest::where(function ($query) use ($user) {
                            $query->where('sender_id', auth()->id())->where('receiver_id', $user->id);
                        })
                            ->orWhere(function ($query) use ($user) {
                                $query->where('sender_id', $user->id)->where('receiver_id', auth()->id());
                            })
                            ->whereIn('status', ['accepted', 'pending'])
                            ->exists();

                    @endphp

                    @if (!$isFriend)
                        <div
                            class="w-[300px] h-auto bg-slate-500 rounded-xl flex flex-col gap-9 items-center justify-center p-10">
                            <img src="{{ asset($user->img) }}" alt=""
                                class="w-[100px] h-[100px] object-cover rounded-full">
                            <p>{{ $user->name . ' ' . $user->surname }}</p>
                            <form action="{{ route('friends.send', $user->id) }}" method="POST">
                                @csrf
                                <div class="flex flex-col text-center gap-1">

                                    <button type="submit"
                                    class=" w-full px-8 py-4 rounded-xl text-gray-700 bg-slate-300">Dergo Kerkese</button>
                                    <a href="{{ route('profile.show', $user->id) }}" class="w-full px-8 py-4 rounded-xl text-gray-700 bg-slate-300">Shiko Profilin</a>
                                </div>
                            </form>
                        </div>
                        @php
                            $noUsersFound = false;
                        @endphp
                    @endif
                @endforeach

                @if ($noUsersFound)
                    <x-empty>Ju nuk mundeni te dergoni Kerkesa</x-empty>
                @endif
            </div>
        </div>

        <div x-show="tab === 'sent'">
            <h3 class="my-10">Kerkesat e Derguara</h3>
            @php
                $noSentRequests = true;
                $hasSentRequests = $sentRequests->isNotEmpty();

            @endphp
            @if ($hasSentRequests)

                <div class="relative overflow-x-auto shadow-center sm:rounded-lg">
                    <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-gray-400 text-left">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">#</th>
                                <th class="px-6 py-3">Emri & Mbiemri</th>
                                <th class="px-6 py-3">Universiteti</th>
                                <th class="px-6 py-3">Aksionet</th>
                            </tr>
                        </thead>
                        @foreach ($sentRequests as $request)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4">
                                    <img src="{{ asset($request->receiver->img) }}" alt=""
                                        class="w-[100px] h-[100px] object-cover rounded-full">

                                </td>
                                <td class="px-6 py-4">
                                    <h4 class="text-white font-bold capitalize text-xl">
                                        {{ $request->receiver->name . ' ' . $request->receiver->surname }}</h4>
                                </td>

                                <td>
                                    <x-school-tag>{{ $request->receiver->uni }}</x-school-tag>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('friends.cancel', $request->receiver->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="text-white shadow-center bg-slate-500 p-3 rounded-md font-bold shadow-gray-400 hover:scale-105 transition-all duration-300">Anulo Kerkesen</button>
                                    </form>
                                </td>
                            </tr>


                            @php
                                $noSentRequests = false;

                            @endphp
                        @endforeach
                    </table>
                </div>
            @else
                <x-empty>Ju nuk keni derguar kerkesa!</x-empty>
            @endif
        </div>

        <div x-show="tab === 'received'">
            <h3 class="my-10">Kerkesat e Marra</h3>
            @php
                $noReceivedRequests = $receivedRequests->isEmpty();

            @endphp
            @if (!$noReceivedRequests)

                <div class="relative overflow-x-auto shadow-center sm:rounded-lg">

                    <table class="w-full text-sm rtl:text-right text-gray-500 dark:text-gray-400 text-left">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">#</th>
                                <th class="px-6 py-3">Emri dhe Mbiemri</th>
                                <th class="px-6 py-3">Universiteti</th>
                                <th class="px-6 py-3">Aksionet</th>
                            </tr>
                        </thead>
                        @foreach ($receivedRequests as $request)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                <td class="px-6 py-4">
                                    <img src="{{ asset($request->sender->img) }}" alt=""
                                        class="w-[100px] h-[100px] object-cover rounded-full">

                                </td>
                                <td class="px-6 py-4">
                                    <h4 class="text-white font-bold capitalize text-xl">
                                        {{ $request->sender->name . ' ' . $request->sender->surname }}</h4>

                                </td>
                                <td class="px-6 py-4">
                                    <x-school-tag>{{ $request->sender->uni }}</x-school-tag>
                                </td>
                                <td class="px-6 py-4 align-middle ">
                                    <div class="flex gap-2 items-center">
                                        <form action="{{ route('friends.accept', $request->sender->id) }}"
                                            method="POST" class="h-full">
                                            @csrf
                                            <button type="submit"
                                                class=" text-white shadow-center bg-slate-500 p-3 rounded-md font-bold shadow-gray-400 hover:scale-105 transition-all duration-300">Prano</button>
                                        </form>
                                        <form action="{{ route('friends.decline', $request->sender->id) }}"
                                            method="POST" class="h-full">
                                            @csrf
                                            <button type="submit"
                                                class=" text-white shadow-center bg-red-900 p-3 rounded-md font-bold shadow-gray-400 hover:scale-105 transition-all duration-300">Refuzo</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>


                            @php
                                $noReceivedRequests = false;
                            @endphp
                        @endforeach


                    </table>
                </div>
            @else
                <x-empty>Ju nuk keni marre asnje kerkese!</x-empty>
            @endif

        </div>
    </div>

    </div>
</x-layout>
