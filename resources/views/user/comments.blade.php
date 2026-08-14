<x-layout>
  <x-slot:title>
    Мои отзывы
  </x-slot:title>

  <main class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

      <!-- Заголовок и вкладки -->
      <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Мой кабинет</h1>
        <div class="mt-4 border-b border-gray-200">
          <nav class="-mb-px flex space-x-8">
            <a href="{{ route('profile') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
              Персональные данные
            </a>
            <a href="{{ route('favorites') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
              Избранные книги
            </a>
            <a href="{{ route('comments') }}" class="border-indigo-600 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm">
              Мои отзывы
            </a>
          </nav>
        </div>
      </div>

      <!-- Список отзывов пользователя -->
      <div id="user-reviews-container" class="space-y-6">

        <!-- Карточка одного отзыва -->
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-6 flex flex-col md:flex-row justify-between gap-6">

          <!-- Левая часть: Сам отзыв -->
          <div class="flex-1 flex flex-col justify-between space-y-4">
            <div>
              <div class="flex items-center space-x-3 mb-2">
                <!-- Оценка пользователя -->
                <div class="flex items-center text-amber-400 text-sm">
                  ★★★★★
                </div>
                <span class="text-xs text-gray-400">Оставлен: 10 июня 2026</span>
              </div>
              <p class="text-gray-700 text-sm leading-relaxed">
                ${commentText}
              </p>
            </div>

            <!-- Кнопки управления (удалить/редактировать отзыв) -->
            <div class="flex space-x-4 text-xs font-medium pt-2">
              <button type="button" class="text-gray-400 hover:text-indigo-600 transition-colors">Редактировать</button>
              <button type="button" class="text-gray-400 hover:text-red-600 transition-colors">Удалить</button>
            </div>
          </div>

          <!-- Правая часть: Мини-карточка привязанной книги -->
          <div class="w-full md:w-80 flex-shrink-0 bg-gray-50 rounded-xl p-3 border border-gray-200/80 flex items-center space-x-3">
            <img src="${bookCoverUrl}" alt="${bookTitle}" class="w-16 h-20 object-cover rounded-lg shadow-sm flex-shrink-0">

            <div class="overflow-hidden">
              <span class="text-[10px] font-bold text-indigo-600 uppercase tracking-wider block">${bookGenre}</span>
              <a href="/books/${bookId}" class="text-sm font-bold text-gray-900 hover:text-indigo-600 transition-colors line-clamp-1" title="${bookTitle}">
                ${bookTitle}
              </a>
              <p class="text-xs text-gray-500 mt-0.5">${bookAuthor}</p>
              <span class="text-xs font-bold text-gray-900 mt-1 block">${bookPrice} ₽</span>
            </div>
          </div>

        </div>

      </div>

    </div>
  </main>
</x-layout>