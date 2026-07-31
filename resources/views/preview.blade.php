<x-layout>
  <x-slot:title>
    Главная
  </x-slot:title>

  <main class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

      <!-- Заголовок каталога -->
      <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Каталог книг</h1>
        <p class="mt-1 text-sm text-gray-500">Исследуйте доступные издания в нашей библиотеке</p>
      </div>

      <!-- Книги -->
      <div id="books-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      </div>

      <!-- Пагинация -->
      <div id="pagination-container" class="mt-10 flex items-center justify-center space-x-4">
        <button id="prev-btn" class="px-4 py-2 text-sm font-medium rounded-lg border bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed" disabled>
          Назад
        </button>

        <span id="page-info" class="text-sm text-gray-600 font-medium px-2">
          Страница 1
        </span>

        <button id="next-btn" class="px-4 py-2 text-sm font-medium rounded-lg border bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed" disabled>
          Вперед
        </button>
      </div>

    </div>
  </main>

  <x-slot:scripts>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const pageInfo = document.getElementById('page-info');
        let prevUrl = null;
        let nextUrl = null;

        prevBtn.addEventListener('click', () => {
          if (prevUrl) loadBooks(prevUrl);
        });
        nextBtn.addEventListener('click', () => {
          if (nextUrl) loadBooks(nextUrl);
        });

        async function loadBooks(url = '/api/books') {
          try {
            const response = await fetch(url, {
              method: 'GET',
              headers: {
                'Accept': 'application/json'
              }
            });

            const json = await response.json();

            if (response.ok) {
              const data = json.data
              const links = json.links
              const meta = json.meta

              console.log("Данные книг:", data);
              console.log("Ссылки пагинации:", links);
              // книги
              cards(data);
              // пагинация
              if (links) {
                pagination(links, meta);
              }
            }
          } catch (error) {
            console.error('Ошибка получения данных: ', error);
          }
        }

        function cards(books) {
          const container = document.getElementById('books-container');
          container.innerHTML = '';

          books.forEach(book => {
            const title = book.title
            const description = book.description 
            const price = book.price
            const oldPrice = book.old_price
            const year = book.year
            const genre = book.genre.name 
            const authorFirstName = book.author.first_name

            const card = `
              <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-100 flex flex-col justify-between">
                <div class="p-6">
                  <div class="flex items-center justify-between text-xs font-semibold mb-3">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">
                      ${genre}
                    </span>
                    <span class="text-gray-400">${year} г.</span>
                  </div>

                  <h3 class="text-xl font-bold text-gray-900 line-clamp-1 hover:text-indigo-600 transition-colors cursor-pointer" title="${title}">
                    ${title}
                  </h3>

                  <p class="text-sm font-medium text-gray-600 mt-1">
                    ${authorFirstName}
                  </p>

                  <p class="mt-3 text-sm text-gray-500 line-clamp-3 leading-relaxed">
                    ${description}
                  </p>
                </div>

                <div class="px-6 pb-6 pt-2 border-t border-gray-50 flex items-center justify-between mt-auto">
                  <div class="flex flex-col">
                    <span class="text-xs text-gray-400 line-through">${oldPrice} ₽</span>
                    <span class="text-xl font-extrabold text-gray-900">${price} ₽</span>
                  </div>

                  <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    В корзину
                  </button>
                </div>
              </div>
            `;

            container.insertAdjacentHTML('beforeend', card);
          });
        }

        function pagination(links, meta) {
          prevUrl = links.prev || null;
          nextUrl = links.next || null;

          toggleButton(prevBtn, prevUrl);
          toggleButton(nextBtn, nextUrl);

          if (meta) {
            pageInfo.textContent = `Страница ${meta.current_page} из ${meta.last_page}`;
          }
        }

        function toggleButton(btn, url) {
          btn.disabled = !url;
          if (url) {
            btn.className = "px-4 py-2 text-sm font-medium rounded-lg border bg-white text-gray-700 border-gray-300 hover:bg-gray-50 hover:text-indigo-600 cursor-pointer";
          } else {
            btn.className = "px-4 py-2 text-sm font-medium rounded-lg border bg-gray-100 text-gray-400 border-gray-200 cursor-not-allowed";
          }
        }

        loadBooks();
      });
    </script>
  </x-slot:scripts>
</x-layout>