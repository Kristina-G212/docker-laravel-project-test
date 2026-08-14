<x-layout>
  <x-slot:title>
    Название книги
  </x-slot:title>

  <main class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">

      <!-- Хлебные крошки -->
      <nav class="flex text-sm text-gray-500 mb-6">
        <a href="/" class="hover:text-indigo-600 transition-colors">Главная</a>
        <span class="mx-2">/</span>
        <a href="/books" class="hover:text-indigo-600 transition-colors">Книги</a>
        <span class="mx-2">/</span>
        <span id="breadcrumb-title" class="text-gray-900 font-medium"></span>
      </nav>

      <!-- Основная карточка книги -->
      <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 lg:p-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">

          <!-- Левая колонка: Галерея / Карусель обложек (5 колонок) -->
          <div class="lg:col-span-5 flex flex-col">
            <!-- Главное изображение -->
            <div class="relative w-full h-96 lg:h-[420px] bg-gray-100 rounded-xl overflow-hidden shadow-inner flex items-center justify-center">
              <img id="main-cover" class="w-full h-full object-cover">
            </div>

            <!-- Мини-карусель (превью) -->
            <div class="flex space-x-3 mt-4 overflow-x-auto pb-2 scrollbar-none">
              <!-- Интеграция через map: активное изображение можно подсвечивать border-indigo-600 -->
              <button type="button" class="w-20 h-24 flex-shrink-0 rounded-lg overflow-hidden border-2 border-indigo-600 focus:outline-none transition-all">
                <img class="w-full h-full object-cover" alt="Миниатюра 1">
              </button>
              <button type="button" class="w-20 h-24 flex-shrink-0 rounded-lg overflow-hidden border-2 border-transparent hover:border-gray-300 focus:outline-none transition-all">
                <img class="w-full h-full object-cover" alt="Миниатюра 2">
              </button>
            </div>
          </div>

          <!-- Правая колонка: Информация о книге (7 колонок) -->
          <div class="lg:col-span-7 flex flex-col justify-between">
            <div>
              <!-- Теги / Жанры -->
              <div class="flex flex-wrap gap-2 mb-3">
                <span id="genre" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700"></span>
              </div>

              <!-- Заголовок -->
              <h1 id="title" class="text-3xl font-extrabold text-gray-900 sm:text-4xl"></h1>

              <!-- Авторы и год -->
              <div class="mt-2 flex items-center space-x-4 text-sm text-gray-600">
                <p class="font-medium text-gray-900">Автор: <span id="author" class="text-indigo-600"></span></p>
                <span>•</span>
                <p>Год издания: <span id="year" class="font-semibold"></span></p>
              </div>

              <!-- Быстрый рейтинг -->
              <div class="mt-4 flex items-center space-x-2">
                <div class="flex items-center text-amber-400">★★★★★</div>
                <span id="avg-rating-up" class="text-sm font-bold text-gray-900"></span>
                <span id="comment-count-up" class="text-sm text-gray-500"></span>
              </div>

              <!-- Описание -->
              <div class="mt-6">
                <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider">Описание</h3>
                <p id="description" class="mt-2 text-base text-gray-600 leading-relaxed"></p>
              </div>
            </div>

            <!-- Цена и покупка -->
            <div class="mt-8 pt-6 border-t border-gray-100">
              <div class="flex items-baseline space-x-3 mb-4">
                <span id="price" class="text-3xl font-extrabold text-gray-900"></span>
                <span id="old-price" class="text-lg text-gray-400 line-through"></span>
              </div>

              <div class="flex flex-col sm:flex-row gap-4">
                <button type="button" class="flex-1 inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-xl shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                  <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                  </svg>
                  Добавить в корзину
                </button>

                <button type="button" class="inline-flex justify-center items-center px-4 py-3 border border-gray-300 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                  <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                  </svg>
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>

      <!-- СЕКЦИЯ ОТЗЫВОВ И ОЦЕНОК -->
      <section class="mt-12 bg-white rounded-2xl shadow-md border border-gray-100 p-6 lg:p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Отзывы читателей</h2>

        <!-- Блок расчета общего рейтинга -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 p-6 bg-gray-50 rounded-xl border border-gray-200/60 mb-8 items-center">

          <div class="md:col-span-4 flex flex-col items-center justify-center text-center border-b md:border-b-0 md:border-r border-gray-200 pb-6 md:pb-0">
            <span id="avg-rating" class="text-5xl font-black text-gray-900"></span>
            <div class="flex items-center text-amber-400 my-2 text-xl">★★★★★</div>
            <span id="comment-count" class="text-sm font-medium text-gray-500"></span>
          </div>

          <div class="md:col-span-8 w-full p-4 bg-white rounded-lg shadow">
            <div class="relative w-full h-48">
              <canvas id="ratingsChart" class="w-full h-full"></canvas>
            </div>
          </div>

        </div>

        <!-- Панель сортировки и фильтрации отзывов -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 mb-6 border-b border-gray-100">
          <div class="text-sm text-gray-500 font-medium">
            Фильтры и сортировка
          </div>

          <div class="flex flex-wrap items-center gap-3">
            <!-- 1. Сортировка по дате / оценке -->
            <div class="relative">
              <select id="sort-comments" class="w-full sm:w-auto appearance-none bg-gray-50 border border-gray-200 text-gray-700 text-sm rounded-xl pl-3 pr-8 py-2 font-medium hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all cursor-pointer">
                <option value="sortFromNewToOld">Сначала новые</option>
                <option value="sortFromOldToNew">Сначала старые</option>
                <option value="sortFromGoodToBad">Сначала с высокой оценкой</option>
                <option value="sortFromBadToGood">Сначала с низкой оценкой</option>
              </select>
              <!-- Стрелочка кастомная для красоты -->
              <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-500">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Список отзывов -->
        <div id="comments-container" class="space-y-6"></div>
      </section>
    </div>
  </main>
  <x-slot:scripts>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {

        const id = document.URL.split('/').pop();

        let ratingsChart = null;
        let values = ''

        document.getElementById('sort-comments').addEventListener('change', function(event) {
          const option = document.getElementById('sort-comments').value
          let sortDateComment = ''
          let sortRating = ''

          switch (option) {
            case 'sortFromNewToOld':
              sortDateComment = 'sortFromNewToOld'
              break;
            case 'sortFromOldToNew':
              sortDateComment = 'sortFromOldToNew'
              break;
            case 'sortFromBadToGood':
              sortRating = 'sortFromBadToGood'
              break;
            case 'sortFromGoodToBad':
              sortRating = 'sortFromGoodToBad'
              break;
            default:
              break;
          }

          values = `&sortDateComment=${sortDateComment}&sortRating=${sortRating}`
          loadCommentsForCurrentBook()
        })

        function initChart(r1, r2, r3, r4, r5) {
          const canvas = document.getElementById('ratingsChart');
          if (!canvas) {
            console.error("no id ratingsChart");
            return;
          }

          const ctx = canvas.getContext('2d');
          const totalReviews = r1 + r2 + r3 + r4 + r5

          if (ratingsChart) {
            ratingsChart.destroy();
          }

          ratingsChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels: ['5 звёзд', '4 звезды', '3 звезды', '2 звезды', '1 звезда'],
              datasets: [{
                data: [r5, r4, r3, r2, r1],
                backgroundColor: '#fbbf24',
                borderRadius: 9999,
                barThickness: 10,
              }]
            },
            options: {
              indexAxis: 'y',
              responsive: true,
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  display: false
                },
                tooltip: {
                  callbacks: {
                    label: function(context) {
                      return context.raw + '%';
                    }
                  }
                }
              },
              scales: {
                x: {
                  max: totalReviews,
                  grid: {
                    display: false,
                    drawBorder: false
                  },
                  ticks: {
                    callback: function(value) {
                      if (totalReviews === 0) return '0%';
                      return Math.round((value / totalReviews) * 100) + '%';
                    }
                  }
                },
                y: {
                  grid: {
                    display: false
                  }
                }
              }
            }
          });
        }

        async function loadCommentsForCurrentBook(url = `/api/comments?book_id=${id}${values}`) {
          try {
            const response = await fetch(url, {
              method: 'GET',
              headers: {
                'Accept': 'application/json'
              }
            })

            const jsonData = await response.json();

            if (response.ok) {
              const data = jsonData.data
              const links = jsonData.links
              const meta = jsonData.meta
              commentsCards(data);
            }

          } catch (error) {
            console.log(error)
          }
        }

        function commentsCards(comments) {
          const container = document.getElementById('comments-container')
          container.innerHTML = '';

          comments.forEach(comment => {
            const nickname = comment.user_nickname
            const createdAt = comment.created_at.split('T')[0]
            const rating = comment.rating
            const description = comment.description
            const plus = comment.plus
            const minus = comment.minus

            const commentCard =
              `
              <!-- Один отзыв с плюсами и минусами -->
              <div class="p-5 border border-gray-100 rounded-xl bg-white shadow-sm space-y-4">

                <!-- Шапка отзыва: Автор, дата и оценка -->
                <div class="flex items-center justify-between">
                  <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold">
                      JD
                    </div>
                    <div>
                      <h4 class="text-sm font-bold text-gray-900">${nickname}</h4>
                      <span class="text-xs text-gray-400">${createdAt}</span>
                    </div>
                  </div>
                  <div class="flex items-center text-amber-400 text-sm">${rating}</div>
                </div>

                <!-- Основной комментарий -->
                <p class="text-sm text-gray-700 leading-relaxed">${description}</p>

                <!-- Блок Плюсов и Минусов -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 border-t border-gray-50">

                  <!-- Плюсы -->
                  <div class="flex items-start space-x-2.5 p-3 rounded-lg bg-emerald-50/60 border border-emerald-100/60">
                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 font-extrabold text-xs flex-shrink-0 mt-0.5">+</span>
                    <div class="text-xs">
                      <span class="font-bold text-emerald-900 block mb-0.5">Плюсы:</span>
                      <p class="text-gray-600 leading-normal">${plus}</p>
                    </div>
                  </div>

                  <!-- Минусы -->
                  <div class="flex items-start space-x-2.5 p-3 rounded-lg bg-rose-50/60 border border-rose-100/60">
                    <span class="inline-flex items-center justify-center w-5 h-5 rounded-full bg-rose-100 text-rose-700 font-extrabold text-xs flex-shrink-0 mt-0.5">−</span>
                    <div class="text-xs">
                      <span class="font-bold text-rose-900 block mb-0.5">Минусы:</span>
                      <p class="text-gray-600 leading-normal">${minus}</p>
                    </div>
                  </div>
                </div>
              </div>
            `;

            container.insertAdjacentHTML('beforeend', commentCard)
          })
        }

        async function bookStatistic() {
          try {
            const response = await fetch(`/api/bookstatistic?book_id=${id}`, {
              method: 'GET',
              headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
              }
            })

            const jsonData = await response.json();

            if (response.ok) {
              const avgRating = jsonData.average_rating
              const commentCount = jsonData.comment_count
              const rating1 = jsonData.rating_1 || 0
              const rating2 = jsonData.rating_2 || 0
              const rating3 = jsonData.rating_3 || 0
              const rating4 = jsonData.rating_4 || 0
              const rating5 = jsonData.rating_5 || 0

              document.getElementById('avg-rating-up').innerHTML = avgRating || ''
              document.getElementById('comment-count-up').innerHTML = `(${commentCount})` || ''

              document.getElementById('avg-rating').innerHTML = avgRating || ''
              document.getElementById('comment-count').innerHTML = `На основе ${commentCount} отзывов` || ''

              initChart(rating1, rating2, rating3, rating4, rating5);
            } else {
              initChart(0, 0, 0, 0, 0);
            }

          } catch (error) {
            console.error(error)
          }
        }

        async function loadCurrentBook() {
          try {
            const response = await fetch(`/api/books?id=${id}`, {
              method: 'GET',
              headers: {
                'Accept': 'application/json'
              }
            });

            const jsonData = await response.json();

            if (response.ok) {
              const data = jsonData.data[0]
              const author = jsonData.data[0].author
              const genre = jsonData.data[0].genre

              document.getElementById('author').innerHTML = author.first_name || ''
              document.getElementById('genre').innerHTML = genre.name || ''
              document.getElementById('year').innerHTML = `${data.year} г.` || ''
              document.getElementById('price').innerHTML = `${data.price} ₽` || ''
              document.getElementById('old-price').innerHTML = `${data.old_price} ₽` || ''
              document.getElementById('description').innerHTML = data.description || ''
              document.getElementById('breadcrumb-title').innerHTML = data.title || ''
              document.getElementById('title').innerHTML = data.title || ''
            }

          } catch (error) {
            console.error(error)
          }
        }

        bookStatistic();
        loadCurrentBook();
        loadCommentsForCurrentBook();
      })
    </script>
  </x-slot:scripts>
</x-layout>