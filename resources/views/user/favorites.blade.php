<x-layout>
  <x-slot:title>
    Избранное
  </x-slot:title>

  <main class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

      <!-- Заголовок и вкладки профиля -->
      <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Мой кабинет</h1>

        <!-- Меню навигации личного кабинета -->
        <div class="mt-4 border-b border-gray-200">
          <nav class="-mb-px flex space-x-8">
            <a href="{{ route('profile') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
              Персональные данные
            </a>
            <a href="{{ route('favorites') }}" class="border-indigo-600 text-indigo-600 whitespace-nowrap py-4 px-1 border-b-2 font-semibold text-sm">
              Избранные книги
            </a>
            <a href="{{ route('comments') }}" class="border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
              Мои отзывы
            </a>
          </nav>
        </div>
      </div>

      <!-- Контейнер с карточками книг -->
      <div id="favorites-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"></div>

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

        async function loadBooks(url = '/api/user/favorite') {
          try {
            const response = await fetch(url, {
              method: 'GET',
              headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('api_token')}`
              }
            });

            const json = await response.json();

            if (response.ok) {
              const data = json.data
              const links = json.links
              const meta = json.meta

              console.log("Данные книг:", json);
              console.log("Данные книг:", data);
              console.log("Данные media:", data[0].book.media);
              data[0].book.media.forEach(url => {
                const picture = url.url
                console.log(picture)
              });
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
          const container = document.getElementById('favorites-container');
          container.innerHTML = '';

          books.forEach(book => {
            const id = book.book.id
            const title = book.book.title
            const description = book.book.description
            const price = book.book.price
            const oldPrice = book.book.old_price
            const year = book.book.year
            const genre = book.book.genre.name
            const authorFirstName = book.book.author.first_name
            const bookPicture = book.book.media[0].url

            const card = `
            <!-- Карточка книги в избранном -->
            <div class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100 flex flex-col justify-between">

              <!-- Картинка + Кнопка удаления из избранного -->
              <div class="relative w-full h-64 bg-gray-100 overflow-hidden">
                <img src="${bookPicture}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">

                <button id="add-to-favorites-${id}" type="button" title="Удалить из избранного" class="absolute top-3 right-3 p-2 rounded-full bg-white/90 text-red-500 hover:bg-white shadow-sm transition-colors">
                  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                  </svg>
                </button>

                <span class="absolute top-3 left-3 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-white/90 backdrop-blur-sm text-indigo-700 shadow-sm">
                  ${genre}
                </span>
              </div>

              <!-- Текстовая часть -->
              <div class="p-6 flex-1 flex flex-col justify-between">
                <div>
                  <span class="text-xs font-semibold text-gray-400">${year} г.</span>
                  <h3 class="text-xl font-bold text-gray-900 line-clamp-1 group-hover:text-indigo-600 transition-colors mt-1">
                    ${title}
                  </h3>
                  <p class="text-sm font-medium text-gray-600 mt-1">${authorFirstName}</p>
                </div>
              </div>

              <!-- Подвал карточки -->
              <div class="px-6 pb-6 pt-3 border-t border-gray-50 flex items-center justify-between mt-auto">
                <span class="text-xl font-extrabold text-gray-900">${price} ₽</span>
                <button type="button" class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                  В корзину
                </button>
              </div>

            </div>
            `;

            container.insertAdjacentHTML('beforeend', card);

            const addToFavBtn = document.getElementById(`add-to-favorites-${id}`)
            addToFavBtn.addEventListener('click', function(event) {
              console.log('click ', id)
              if (localStorage.getItem('api_token')) {
                addToFavorites(id)
              }
            })
          });
        }

        async function addToFavorites(id) {
          try {
            const response = await fetch('/api/user/favorite', {
              method: 'DELETE',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('api_token')}`
              },
              body: JSON.stringify({
                book_id: id,
              })
            })

            const jsonData = await response.json()

            if (response.ok) {
              console.log(jsonData.error || jsonData.message)
              window.location.reload();
            } else {
              console.log(jsonData.error || jsonData.message)
            }
          } catch (error) {
            console.log(error)
          }
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

        function getLink(element) {
          console.log(element.href)
        }
      });
    </script>
  </x-slot:scripts>
</x-layout>