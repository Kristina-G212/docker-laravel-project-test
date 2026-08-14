<x-layout>
  <x-slot:title>
    Главная
  </x-slot:title>

  <div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Заголовок каталога -->
      <div class="mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900">Каталог книг</h1>
        <p class="mt-1 text-sm text-gray-500">Исследуйте доступные издания в нашей библиотеке</p>
      </div>

      <!-- Блок фильтрации и сортировки -->
      <form id="filter-form" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mb-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

          <!-- Фильтр: Автор -->
          <div>
            <label for="author" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Автор</label>
            <select id="authors-container" name="author" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none bg-white transition">
              <option value="">Все авторы</option>
            </select>
          </div>

          <!-- Фильтр: Жанр -->
          <div>
            <label for="genre" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Жанр</label>
            <select id="genres-container" name="genre" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none bg-white transition">
              <option value="">Все жанры</option>
            </select>
          </div>

          <!-- Фильтр: Год издания (От - До) -->
          <div>
            <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Год издания</label>
            <div class="flex items-center space-x-2">
              <input type="number" id="fromYear" name="from" placeholder="От"
                class="w-1/2 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" />
              <span class="text-gray-400">-</span>
              <input type="number" id="toYear" name="to" placeholder="До"
                class="w-1/2 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" />
            </div>
          </div>

          <!-- Сортировка: По дате/году -->
          <div>
            <label for="sortDate" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">По году</label>
            <select id="sortDate" name="sortDate" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none bg-white transition">
              <option value="">По умолчанию</option>
              <option value="sortFromOldToNew">Сначала старые</option>
              <option value="sortFromNewToOld">Сначала новые</option>
            </select>
          </div>

          <!-- Сортировка: По цене -->
          <div>
            <label for="sortPrice" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">По цене</label>
            <select id="sortPrice" name="sortPrice" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none bg-white transition">
              <option value="">По умолчанию</option>
              <option value="sortFromCheapToExpensive">Сначала дешевле</option>
              <option value="sortFromExpensiveToCheap">Сначала дороже</option>
            </select>
          </div>

        </div>

        <!-- Кнопки управления -->
        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-end space-x-3">
          <button id="reset-sort-and-filter-btn" type="button" class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors">
            Сбросить
          </button>
          <button id="sort-and-filter-btn" type="submit" class="px-5 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:ring-offset-1 transition-all">
            Применить
          </button>
        </div>
      </form>

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
  </div>

  <x-slot:scripts>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const pageInfo = document.getElementById('page-info');
        let prevUrl = null;
        let nextUrl = null;

        let values = ''

        prevBtn.addEventListener('click', () => {
          if (prevUrl) loadBooks(prevUrl);
        });
        nextBtn.addEventListener('click', () => {
          if (nextUrl) loadBooks(nextUrl);
        });

        async function loadAuthors() {
          try {
            const response = await fetch('/api/authors', {
              method: 'GET',
              headers: {
                'Accept': 'application/json'
              }
            });

            const jsonData = await response.json();

            if (response.ok) {
              const data = jsonData.data
              authors(data)
            }

          } catch (error) {
            console.error(error)
          }
        }

        function authors(authors) {
          const container = document.getElementById('authors-container')
          container.innerHTML = '<option value="">Все авторы</option>'

          authors.forEach(author => {
            const firstName = author.first_name

            const toInput = `<option value="${firstName}">${firstName}</option>`
            container.insertAdjacentHTML('beforeend', toInput);
          })
        }

        async function loadGenres() {
          try {
            const response = await fetch('/api/genres', {
              method: 'GET',
              headers: {
                'Accept': 'application/json'
              }
            });

            const jsonData = await response.json();

            if (response.ok) {
              const data = jsonData.genre
              genres(data)
            }

          } catch (error) {
            console.error(error)
          }
        }

        function genres(genres) {
          const container = document.getElementById('genres-container')
          container.innerHTML = '<option value="">Все жанры</option>'

          genres.forEach(genre => {
            const bookGenre = genre.name

            const toInput = `<option value="${bookGenre}">${bookGenre}</option>`
            container.insertAdjacentHTML('beforeend', toInput);
          })
        }

        document.getElementById('sort-and-filter-btn').addEventListener('click', async function sortAndFilterBooks(event) {
          event.preventDefault();

          const sortDateValue = document.getElementById('sortDate').value
          const sortPriceValue = document.getElementById('sortPrice').value
          const authorValue = document.getElementById('authors-container').value
          const genreValue = document.getElementById('genres-container').value
          const fromYearValue = document.getElementById('fromYear').value
          const toYearValue = document.getElementById('toYear').value

          values = `?sortDate=${sortDateValue}&sortPrice=${sortPriceValue}&author=${authorValue}&genre=${genreValue}&from=${fromYearValue}&to=${toYearValue}`;
          loadBooks();
        })

        document.getElementById('reset-sort-and-filter-btn').addEventListener('click', async function sortAndFilterBooks(event) {
          event.preventDefault()
          values = ''
          loadBooks();
        })

        async function loadBooks(url = `/api/books${values}`) {
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
              // книги
              cards(data);
              // пагинация
              if (links) {
                pagination(links, meta);
              }
            }

          } catch (error) {
            console.error(error);
          }
        }

        function cards(books) {
          const container = document.getElementById('books-container');
          container.innerHTML = '';

          books.forEach(book => {
            const id = book.id
            const title = book.title
            const description = book.description
            const price = book.price
            const oldPrice = book.old_price
            const year = book.year
            const genre = book.genre.name
            const authorFirstName = book.author.first_name
            const bookPicture = book.media[0].url

            const card = `
            <div class="group bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 border border-gray-100 flex flex-col justify-between">
              
              <!-- Блок с картинкой / обложкой -->
              <div class="relative w-full h-64 bg-gray-100 overflow-hidden flex items-center justify-center">
                <img 
                  src="${bookPicture}" 
                  alt="${title}" 
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                />
                
                <!-- Бейдж жанра поверх обложки -->
                <span class="absolute top-3 left-3 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-white/90 backdrop-blur-sm text-indigo-700 shadow-sm">
                  ${genre}
                </span>
              </div>

              <!-- Контентная часть -->
              <div class="p-6 flex-1 flex flex-col justify-between">
                <div>
                  <div class="flex items-center justify-between text-xs font-semibold text-gray-400 mb-2">
                    <span>${year} г.</span>
                  </div>

                  <h3 class="text-xl font-bold text-gray-900 line-clamp-1 group-hover:text-indigo-600 transition-colors cursor-pointer" title="${title}">
                    ${title}
                  </h3>

                  <p class="text-sm font-medium text-gray-600 mt-1">
                    ${authorFirstName}
                  </p>

                  <p class="mt-3 text-sm text-gray-500 line-clamp-3 leading-relaxed">
                    ${description}
                  </p>
                </div>
              </div>

              <!-- Нижняя часть: Цены и Кнопки -->
              <div class="px-6 pb-6 pt-3 border-t border-gray-50 flex items-center justify-between gap-3 mt-auto">
                <div class="flex flex-col flex-shrink-0">
                  <span class="text-xs text-gray-400 line-through">${oldPrice} ₽</span>
                  <span class="text-xl font-extrabold text-gray-900">${price} ₽</span>
                </div>

                <div class="flex items-center space-x-2">
                  <!-- В избранное -->
                  <button id="add-to-favorites-${id}" type="button" title="Добавить в избранное" class="inline-flex items-center justify-center p-2 rounded-lg border border-gray-200 text-gray-400 hover:text-red-500 hover:bg-red-50 hover:border-red-200 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-red-500 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                  </button>

                  <!-- Подробнее -->
                  <a href="/book/${id}" class="inline-flex items-center justify-center px-3.5 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-indigo-500 transition-colors">
                    Подробнее
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                  </a>
                </div>
              </div>

            </div>
            `;

            container.insertAdjacentHTML('beforeend', card);

            const addToFavBtn = document.getElementById(`add-to-favorites-${id}`)
            addToFavBtn.addEventListener('click', function(event) {
              if (localStorage.getItem('api_token')) {
                addToFavorites(id)
              }
            })
          });
        }

        async function addToFavorites(id) {
          try {
            const response = await fetch('/api/user/favorite', {
              method: 'POST',
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
        loadGenres();
        loadAuthors();
      });
    </script>
  </x-slot:scripts>
</x-layout>