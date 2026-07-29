<!DOCTYPE html>
<html lang="en" data-theme="lofi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ isset($title) ? $title . ' - Книги' : 'Книги' }}</title>
</head>

<body class="min-h-screen bg-gray-50 flex flex-col">
  <!-- Шапка / Навигация -->
  <header class="bg-white shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <div class="flex-shrink-0 flex items-center">
          <span class="text-xl font-bold text-indigo-600">Книги</span>
        </div>
        <div class="flex items-center space-x-4">
          <p id='nickname-profile' class="hidden"></p>
          <form id='logout-form' class="hidden inline">
            @csrf
            <button type="submit" class="text-indigo-600 hover:text-indigo-500 font-medium underline border-none bg-transparent p-0 cursor-pointer">
              Выйти
            </button>
          </form>
          <div id='btns' class="hidden flex items-center space-x-4">
            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600">Вход</a>
            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
              Регистрация
            </a>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Success Toast -->
  @if (session('success'))
  <div class="fixed top-5 left-1/2 -translate-x-1/2 z-50 w-full max-w-sm px-4">
    <div class="flex items-center p-4 text-sm text-emerald-800 border border-emerald-200 rounded-lg bg-emerald-50 shadow-lg" role="alert">
      <svg class="flex-shrink-0 inline w-5 h-5 mr-3 text-emerald-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
      <span class="sr-only">Успех:</span>
      <div class="font-medium">
        {{ session('success') }}
      </div>
    </div>
  </div>
  @endif

  <!-- Errors -->
  @if ($errors->any() || session('error'))
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <main class="flex-1 container mx-auto px-4 py-8">
    {{ $slot }}
  </main>

  <footer class="bg-white border-t border-gray-200 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p class="text-xs text-gray-500">
        © {{ date('Y') }} Built with <span class="font-medium text-indigo-600">Laravel</span> and <span class="text-red-500">❤️</span>
      </p>
    </div>
  </footer>

  {{ $scripts ?? '' }}

</body>
<script src="https://cdn.tailwindcss.com"></script>
<script>
  document.addEventListener('DOMContentLoaded', async function(event) {
    const nicknameProfile = document.getElementById('nickname-profile')
    const logout = document.getElementById('logout-form')
    const buttons = document.getElementById('btns')

    if (localStorage.getItem('api_token')) {
      nicknameProfile.classList.remove('hidden');
      logout.classList.remove('hidden');

      try {
        const response = await fetch('/api/user/profile', {
          headers: {
            'Accept': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('api_token')}`,
          }
        })
        if (response.ok) {
          const json = await response.json();
          const user = json.data || json.user || json;
          nicknameProfile.innerText = user.nickname;
        } else {
          localStorage.removeItem('api_token')
          console.error(json.message);
        }
      } catch (error) {
        console.error("Ошибка:", error);
        console.error(json.message);
      }
    } else {
      buttons.classList.remove('hidden')
    }

    document.getElementById('logout-form').addEventListener('submit', async function(event) {
      event.preventDefault();
      const csrfToken = document.querySelector('input[name="_token"]').value;

      try {
        const response = await fetch('/api/logout', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('api_token')}`
          }
        })

        if (response.ok) {
          const json = await response.json();
          console.log(json.message)
        } else {
          console.warn('error when logout, but clear localstorage');
        }
      } catch (error) {
        console.error('error when logout:', error);
      } finally {
        localStorage.removeItem('api_token')
        window.location.href = '/'
      }
    })

  })
</script>

</html>