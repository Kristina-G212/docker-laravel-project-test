<x-layout>
  <x-slot:title>
    Личная страница
  </x-slot:title>

  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <h2 class="text-center text-3xl font-extrabold text-gray-900">
        Личный кабинет
      </h2>
      <h2 id="user-header-nickname" class="text-center text-3xl font-extrabold text-gray-900">
      </h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        Управление учетной записью и персональными данными
      </p>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
      <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">

        <!-- 1. ФОРМА РЕДАКТИРОВАНИЯ ПРОФИЛЯ -->
        <form id="update-profile-form" class="space-y-6">
          <div>
            <h3 class="text-lg font-medium text-gray-900">Личные данные</h3>
            <p class="mt-1 text-sm text-gray-500">Обновите вашу персональную информацию.</p>
          </div>

          <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-2">

            <!-- Имя -->
            <div>
              <label for="first_name" class="block text-sm font-medium text-gray-700">Имя</label>
              <div class="mt-1">
                <input type="text" name="first_name" id="first_name" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
              </div>
            </div>

            <!-- Фамилия -->
            <div>
              <label for="last_name" class="block text-sm font-medium text-gray-700">Фамилия</label>
              <div class="mt-1">
                <input type="text" name="last_name" id="last_name" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
              </div>
            </div>

            <!-- Отчество -->
            <div class="sm:col-span-2">
              <label for="middle_name" class="block text-sm font-medium text-gray-700">Отчество</label>
              <div class="mt-1">
                <input type="text" name="middle_name" id="middle_name" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
              </div>
            </div>

            <!-- Телефон -->
            <div class="sm:col-span-2">
              <label for="phone" class="block text-sm font-medium text-gray-700">Телефон</label>
              <div class="mt-1">
                <input type="tel" name="phone" id="phone" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
              </div>
            </div>

            <!-- Никнейм -->
            <div class="sm:col-span-2">
              <label for="nickname" class="block text-sm font-medium text-gray-700">Никнейм</label>
              <div class="mt-1">
                <input type="text" name="nickname" id="nickname" value="" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
              </div>
            </div>

            <!-- Почта (только для чтения) -->
            <div class="sm:col-span-2">
              <label for="email" class="block text-sm font-medium text-gray-700">Электронная почта</label>
              <div class="mt-1">
                <input type="email" name="email" id="email" value="" disabled class="bg-gray-100 cursor-not-allowed shadow-sm block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border text-gray-500">
              </div>
              <p class="mt-1 text-xs text-gray-500">Адрес электронной почты нельзя изменить.</p>
            </div>

          </div>

          <div class="flex justify-end">
            <button type="submit" class="w-full sm:w-auto flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
              Сохранить данные
            </button>
          </div>
        </form>

        <!-- РАЗДЕЛИТЕЛЬ -->
        <div class="mt-10 pt-8 border-t border-gray-200"></div>

        <!-- 2. ФОРМА СМЕНЫ ПАРОЛЯ -->
        <form id="update-password-form" class="space-y-6">
          <div>
            <h3 class="text-lg font-medium text-gray-900">Безопасность</h3>
            <p class="mt-1 text-sm text-gray-500">Убедитесь, что ваш аккаунт использует надежный пароль.</p>
          </div>

          <div class="space-y-4">
            <!-- Текущий пароль -->
            <div>
              <label for="current_password" class="block text-sm font-medium text-gray-700">Текущий пароль</label>
              <div class="mt-1">
                <input type="password" name="current_password" id="current_password" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
              </div>
            </div>

            <!-- Новый пароль -->
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">Новый пароль</label>
              <div class="mt-1">
                <input type="password" name="password" id="password" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
              </div>
            </div>

            <!-- Повторите новый пароль -->
            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Подтвердите новый пароль</label>
              <div class="mt-1">
                <input type="password" name="password_confirmation" id="password_confirmation" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md p-2.5 border">
              </div>
            </div>
          </div>

          <div class="flex justify-end">
            <button type="submit" class="w-full sm:w-auto flex justify-center py-2.5 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
              Обновить пароль
            </button>
          </div>
        </form>

        <!-- РАЗДЕЛИТЕЛЬ -->
        <div class="mt-10 pt-8 border-t border-gray-200"></div>

        <!-- 3. УДАЛЕНИЕ АККАУНТА -->
        <div>
          <div class="sm:flex sm:items-center sm:justify-between">
            <div>
              <h3 class="text-lg font-medium text-red-600">Удаление аккаунта</h3>
              <p class="mt-1 text-sm text-gray-500">После удаления аккаунта все ваши данные будут стерты без возможности восстановления.</p>
            </div>
            <div class="mt-4 sm:mt-0">
              <form id="delete-account-form">
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2.5 border border-transparent font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 text-sm transition-colors">
                  Удалить аккаунт
                </button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <x-slot:scripts>
    <script>
      document.addEventListener('DOMContentLoaded', async () => {
        const token = localStorage.getItem('api_token');

        if (!token) {
          window.location.href = '/login';
          return;
        }
        console.log('токен с профиля ' + token);

        try {
          const response = await fetch('/api/user/profile', {
            headers: {
              'Authorization': `Bearer ${token}`,
              'Accept': 'application/json'
            }
          });

          if (response.ok) {
            const result = await response.json();

            const user = result.data || result;

            if (user.nickname === null) {
              document.getElementById('user-header-nickname').innerText = 'Пользователь';
            } else {
              document.getElementById('user-header-nickname').innerText = user.nickname || 'Пользователь';
            }

            document.getElementById('first_name').value = user.first_name || '';
            document.getElementById('last_name').value = user.last_name || '';
            document.getElementById('middle_name').value = user.middle_name || '';
            document.getElementById('phone').value = user.phone || '';
            document.getElementById('nickname').value = user.nickname || '';
            document.getElementById('email').value = user.email || '';

          } else {
            localStorage.removeItem('api_token');
            window.location.href = '/login';
          }
        } catch (error) {
          console.error('Ошибка загрузки профиля:', error);
        }

        document.getElementById('update-profile-form').addEventListener('submit', async function(event) {
          event.preventDefault();

          const dataFromForm = document.getElementById('update-profile-form');
          const formData = new FormData(dataFromForm);

          const data = {
            first_name: formData.get('first_name'),
            last_name: formData.get('last_name'),
            middle_name: formData.get('middle_name'),
            nickname: formData.get('nickname'),
            phone: formData.get('phone'),
          }

          console.log(data)

          try {
            const response = await fetch('/api/user/profile', {
              method: 'PUT',
              headers: {
                "Accept": "application/json",
                "Content-Type": "application/json",
                'Authorization': `Bearer ${token}`,
              },
              body: JSON.stringify(data)
            })

            const json = await response.json();
            if (response.ok) {
              console.log(json.message)
            } else {
              console.error(json.message || data.error || data.message)
            }
          } catch (error) {
            console.error('unluck to update', error)
          }
        });

        document.getElementById('update-password-form').addEventListener('submit', async function(event) {
          event.preventDefault();

          const dataFromForm = document.getElementById('update-password-form');
          const formData = new FormData(dataFromForm);

          const data = {
            current_password: formData.get('current_password'),
            password: formData.get('password'),
            password_confirmation: formData.get('password_confirmation'),
          }

          console.log(JSON.stringify(data))

          try {
            const response = await fetch('/api/user/profile/password', {
              method: 'PUT',
              headers: {
                "Accept": "application/json",
                "Content-Type": "application/json",
                'Authorization': `Bearer ${token}`,
              },
              body: JSON.stringify(data)
            })

            const json = await response.json();
            if (response.ok) {
              console.log(json.message)
              dataFromForm.reset();
            } else {
              document.getElementById('password').value = ''
              document.getElementById('password_confirmation').value = ''
              console.error(json.message || data.error || data.message)
            }
          } catch (error) {
            console.error('unluck to change password', error)
          }
        });
      });
    </script>
  </x-slot:scripts>
</x-layout>