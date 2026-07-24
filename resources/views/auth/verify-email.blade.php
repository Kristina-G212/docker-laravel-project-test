<x-layout>
  <x-slot:title>
    Sign In
  </x-slot:title>
  Перейдите по ссылке, которая пришла вам на почту, чтобы подтвердить регистрацию.
  <form method="POST" action="{{ route('verification.send') }}">
    <button type="submit">Отправить новую ссылку</button>
  </form>
  @if (session('message'))
  {{ session('message') }}
  @endif
</x-layout>