<x-layout>
  <div class="flex w-full h-screen items-center justify-center flex-col">
    <img width="300px" src="{{ asset('images/logo.png')}}" alt="">
    <h1 class="m-10 text-4xl font-bold text-white">Kyquni</h1>
    <div class="w-[500px] min-w-lg ">

      <form method="POST" action="/login">
        @csrf
  
        <x-form-input name='email' type="email">Email</x-form-input>
        <x-form-input name="password" type="password">Password</x-form-input>
        <x-form-button class="w-full">Kyqu</x-form-button>
        <a href="/register" class="underline text-white">Nuk jeni regjistruar! Klikoni ketu</a>
      </form>
    </div>
  </div>
</x-layout>