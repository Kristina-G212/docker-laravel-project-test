<x-layout>
  <x-slot:title>
    Sign In
  </x-slot:title>

  <div class="p-6 max-w-lg mx-auto bg-white rounded-lg shadow-md mt-10">
    <div class="text-gray-800 mb-2 font-medium">
      Вы получили на почту 4-х значный код. Введите его здесь.
    </div>
    <p class="text-xs text-gray-500 mb-6">
      Код отправлен на ваш email и действителен в течение 10 минут.
    </p>

    <!-- Элемент для вывода сообщений -->
    <div id="status-message" class="mb-4 text-sm font-semibold text-indigo-600 hidden"></div>

    <!-- Форма отправки кода -->
    <form id="verify-code-form" class="space-y-4">
      <div>
        <label for="code" class="block text-sm font-medium text-gray-700 mb-1">
          Код подтверждения
        </label>
        <input
          type="text"
          id="code"
          name="code"
          maxlength="4"
          placeholder="1234"
          required
          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 outline-none transition text-center text-xl tracking-widest font-bold text-gray-800" />
      </div>

      <!-- Чекбокс "Запомнить меня" -->
      <div class="flex items-center gap-2">
        <input id="remember" name="remember" type="checkbox" class="w-4 h-4 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500">
        <label for="remember" class="text-sm text-gray-600">Запомнить меня</label>
      </div>

      <!-- Кнопка подтверждения -->
      <button
        type="submit"
        id="verify-btn"
        class="w-full px-4 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 transition">
        Подтвердить код
      </button>
    </form>

    <!-- Разделитель и кнопка повторной отправки -->
    <div class="mt-6 pt-6 border-t border-gray-100 flex items-center justify-between text-sm">
      <span class="text-gray-500">Не получили код?</span>
      <form id="resend-form">
        <button id="resend-btn" type="button" class="text-indigo-600 hover:text-indigo-800 font-semibold transition">
          Отправить повторно
        </button>
      </form>
    </div>
  </div>

  <x-slot:scripts>
    <script>
      document.getElementById('verify-code-form').addEventListener('submit', async function(event) {
        event.preventDefault();

        const messageEl = document.getElementById('status-message');
        const token = localStorage.getItem('api_token');
        const email = localStorage.getItem('email');
        const csrfToken = document.querySelector('input[name="_token"]').value;

        const code = document.getElementById('code').value;

        console.log('токен с 2фа ' + token);

        const url = "/api/auth/code";
        const data = {
          email: email,
          code: code,
        };

        try {
          const response = await fetch(url, {
            method: "POST",
            headers: {
              "Accept": "application/json",
              "Content-Type": "application/json",
              'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(data),
          });

          const json = await response.json();

          if (response.ok) {
            console.log("Успех:", JSON.stringify(json));
            console.log(json.message);

            localStorage.setItem('api_token', json.token);
            window.location.href = '/user/profile'
          } else {
            console.error(data.message)
          }

        } catch (error) {
          console.error("Ошибка:", error);
          console.log(json.message);
        }
      });
    </script>
  </x-slot:scripts>
</x-layout>