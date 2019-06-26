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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::name('home')->get('/home', 'HomeController@index');

Route::get('/todo', function () {
    return view('todo');
})->name('todo');

Route::resource('list', 'TodoListController');
// Создаем вложенный роут
Route::resource('list.item','TodoItemController')->except(['index']);
