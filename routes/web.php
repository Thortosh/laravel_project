<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/**
 * Auth::routes() - это просто вспомогательный класс, который помогает вам генерировать все маршруты, необходимые для аутентификации пользователя. (командная строка php artisan make:auth)
 * Route::view - маршрут возвращает представление главной страницы.
 * Метод view принимает URI в качестве первого аргумента и имя представления в качестве второго аргумента.
 * Route::get - Маршрутизатор позволяет регистрировать маршруты для любого HTTP-запроса (забрать имя главной страницы)
 *
 */
Auth::routes();
Route::view('/', 'welcome')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');

/**
 * middleware -Посредники (англ. middleware) предоставляют удобный механизм для фильтрации HTTP-запросов вашего приложения.
 * Например, в Laravel есть посредник для проверки аутентификации пользователя. Если пользователь не аутентифицирован, посредник перенаправит его на экран входа в систему.
 * Если же пользователь аутентифицирован, посредник позволит запросу пройти далее в приложение.
 *
 * Обращаемся к middleware задаем имя 'is_owner' и добавляем в группу два контроллера.
 * (php artisan make:controller TodoListController --resource данная команда сгенерирует контроллер app/Http/Controllers/TodoListController.php. )
 * Теперь мы можем зарегистрировать маршрут контроллера ресурса: Route::resource('list', 'TodoListController'); - списки
 *
 * Создаем вложенный роут Route::resource('list.item','TodoItemController') - содержимое каждого списка
 * Что бы получить только часть данных ввода, используем метод except(). Этот метод принимают один массив или динамический список аргументов:
 *
 *
 *
 */
Route::middleware('auth')->group(function () {
    Route::resource('list', 'TodoListController');
// Создаем вложенный роут
    Route::resource('list.item', 'TodoItemController')->except(['index']);
// группа для паблик страниц, которые будут начинаться с /public и иметь имена нач. с public.
    Route::prefix('public')->name('public.')->group(function (){
        Route::get('/', 'TodopublicController@index')->name('index');
        Route::get('/copy/{list}', 'TodopublicController@copy')->name('copy');
    });
});

Route::get('user/me', 'UserProfileController@me')->name('user.me');
Route::resource('user', 'UserProfileController');
