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
      document.addEventListener("DOMContentLoaded", async () => {
        const messageEl = document.getElementById('status-message');
        const token = localStorage.getItem('api_token'); 

        const currentPath = window.location.pathname;
        const searchParams = window.location.search;

        if (searchParams.includes('signature=')) {
          
          if (!token) {
            messageEl.innerText = "Для подтверждения почты авторизуйтесь в системе на этом устройстве.";
            return;
          }

          messageEl.innerText = "Подтверждаем вашу почту...";
          const apiUrl = `/api${currentPath}${searchParams}`;

          try {
            const response = await fetch(apiUrl, {
              method: "GET",
              headers: {
                "Accept": "application/json",
                "Authorization": `Bearer ${token}`
              }
            });

            const json = await response.json();

            if (response.ok) {
              messageEl.innerText = "Почта успешно подтверждена! Перенаправляем...";
              setTimeout(() => window.location.href = '/user/profile', 1500);
            } else {
              messageEl.innerText = json.message || "Ссылка недействительна или принадлежит другому аккаунту.";
            }
          } catch (error) {
            console.error("Ошибка:", error);
            messageEl.innerText = "Ошибка сети при подтверждении.";
          }
        }
      });
    </script>
  </x-slot:scripts>
</x-layout>