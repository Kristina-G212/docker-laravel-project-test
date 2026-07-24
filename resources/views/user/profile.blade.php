<x-layout>
    <x-slot:title>
        Личная страница
    </x-slot:title>
    @auth
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <h2 class="text-center text-3xl font-extrabold text-gray-900">
        Личный кабинет
        </h2>
        <h2 class="text-center text-3xl font-extrabold text-gray-900">
        {{ auth()->user()->nickname }}
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
        Управление учетной записью и персональными данными
        </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        
        <!-- Форма редактирования данных -->
        <form class="space-y-6" action="#" method="POST">
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">
            
            <!-- Имя -->
            <div>
                <label for="first_name" class="block text-sm font-medium text-gray-700">Имя</label>
                <div class="mt-1">
                <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
                </div>
            </div>

            <!-- Фамилия -->
            <div>
                <label for="last_name" class="block text-sm font-medium text-gray-700">Фамилия</label>
                <div class="mt-1">
                <input type="text" name="last_name" id="last_name" value="{{ auth()->user()->last_name }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
                </div>
            </div>

            <!-- Отчество -->
            <div class="sm:col-span-2">
                <label for="middle_name" class="block text-sm font-medium text-gray-700">Отчество</label>
                <div class="mt-1">
                <input type="text" name="middle_name" id="middle_name" value="{{ auth()->user()->middle_name }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
                </div>
            </div>

            <!-- Телефон -->
            <div class="sm:col-span-2">
                <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
                <div class="mt-1">
                <input type="tel" name="phone" id="phone" value="{{ auth()->user()->phone }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
                </div>
            </div>

            <!-- Никнейм -->
            <div class="sm:col-span-2">
                <label for="phone" class="block text-sm font-medium text-gray-700">Никнейм</label>
                <div class="mt-1">
                <input type="text" name="phone" id="phone" value="{{ auth()->user()->nickname }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
                </div>
            </div>

            <!-- Почта (только для чтения) -->
            <div class="sm:col-span-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Электронная почта</label>
                <div class="mt-1">
                <input type="email" name="email" id="email" value="{{ auth()->user()->email }}" disabled class="bg-gray-100 cursor-not-allowed shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border text-gray-500">
                </div>
                <p class="mt-1 text-xs text-gray-500">Адрес электронной почты нельзя изменить.</p>
            </div>

            </div>

            <!-- Кнопка сохранить / изменить -->
            <div>
            <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                Изменить
            </button>
            </div>
        </form>

        <!-- Разделитель -->
        <div class="mt-10 pt-6 border-t border-gray-200">
            <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-red-600">Удаление аккаунта</h3>
                <p class="text-sm text-gray-500">После удаления аккаунта все ваши данные будут стерты без возможности восстановления.</p>
            </div>
            <button type="button" class="ml-4 inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 text-sm transition-colors">
                Удалить аккаунт
            </button>
            </div>
        </div>

        </div>
    </div>
    </div>
    @endauth
</x-layout>