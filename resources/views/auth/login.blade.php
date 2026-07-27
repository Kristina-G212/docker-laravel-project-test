<x-layout>
  <x-slot:title>
    Sign In
  </x-slot:title>

  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2 class="text-center text-3xl font-extrabold text-gray-900">
        Вход в аккаунт
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        Или <a href="{{ route('view.register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">создайте новый аккаунт</a>
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <form class="space-y-6" action="{{ route('login') }}" method="POST">

          <!-- Почта -->
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Электронная почта или телефон</label>
            <div class="mt-1">
              <input type="text" name="email" id="email" required placeholder="you@example.com или +79991234567" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
            </div>
          </div>

          <!-- Пароль -->
          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
              <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-500">Забыли пароль?</a>
            </div>
            <div class="mt-1">
              <input type="password" name="password" id="password" required class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
            </div>
          </div>

          <!-- Запомнить меня -->
          <div class="flex items-center">
            <input id="remember_me" name="remember_me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
              Запомнить меня
            </label>
          </div>

          <!-- Кнопка -->
          <div>
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
              Войти
            </button>
          </div>
        </form>

        <!-- Или -->
        <div class="mt-6 text-center text-sm">
          <span class="text-gray-600">Нет аккаунта?</span>
          <a href="{{ route('register') }}" class="ml-1 font-medium text-indigo-600 hover:text-indigo-500">
            Создать
          </a>
        </div>
      </div>
    </div>
  </div>
</x-layout>