<x-layout>
    <x-slot:title>
        Register
    </x-slot:title>

    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h2 class="text-center text-3xl font-extrabold text-gray-900">
                Регистрация
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Или <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">войдите в существующий аккаунт</a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-5" action="{{ route('register') }}" method="POST">

                    <!-- Никнейм -->
                    <div>
                        <label for="nickname" class="block text-sm font-medium text-gray-700">Никнейм</label>
                        <div class="mt-1">
                            <input type="text" name="nickname" id="nickname" required placeholder="user123" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
                        </div>
                    </div>

                    <!-- Почта -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Электронная почта</label>
                        <div class="mt-1">
                            <input type="email" name="email" id="email" required placeholder="you@example.com" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
                        </div>
                    </div>

                    <!-- Пароль -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
                        <div class="mt-1">
                            <input type="password" name="password" id="password" required class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
                        </div>
                    </div>

                    <!-- Повторите пароль -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Повторите пароль</label>
                        <div class="mt-1">
                            <input type="password" name="password_confirmation" id="password_confirmation" required class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
                        </div>
                    </div>

                    <!-- Кнопка -->
                    <div>
                        <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Зарегистрироваться
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-layout>