<x-layout>
  <x-slot:title>
    Sign In
  </x-slot:title>

  <div class="p-6 max-w-lg mx-auto bg-white rounded-lg shadow-md mt-10">
    <div class="text-gray-800 mb-4 font-medium">
      Перейдите по ссылке, которая пришла вам на почту, чтобы подтвердить регистрацию.
    </div>

    <!-- Элемент для вывода сообщений -->
    <div id="status-message" class="mb-4 text-sm font-semibold text-indigo-600"></div>

    <form id="resend-form">
      <button id="resend-btn" type="button" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
        Отправить новую ссылку
      </button>
    </form>
  </div>

<x-slot:scripts>
    <script>
      // потом либо переделать эту 2фа либо вернуть подтверждение по ссылке
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