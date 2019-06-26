<?php

namespace App\Http\Controllers;

use App\TodoItem;
use App\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     * Возвращем полученные данные
     * В переменную TodoList записываем все данные из модели (TodoList::all() - получить все модели из базы данных.)
     * Возвращаем страницу
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todolists = TodoList::all();
        return view('todo_list.index', ['todolists' => $todolists]);
    }

    /**
     * Show the form for creating a new resource.
     * Метод create показывает форму
     * @return void
     */
    public function create()
    {
        return view('todo_list.create');
    }

    /**
     * Store a newly created resource in storage.
     * METHOD POST
     * обрабатывает переданные данные
     * $list - создаем объект класса TodoList
     * Записываем в свойство объекта name имя списка
     * Записываем в свойство объекта description описание списка
     * записываем в свойство user_id данные аутентификации (Auth::user()->id - получаем из текущей сессии user, и получаем его id)
     * сохраняем модель и перенаправляем пользователя на страницу list.index
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $list = new TodoList();

        $list->name = $request->get('name');
        $list->description = $request->get('description');
        $list->user_id = \Auth::user()->id;

        $list->save();
        return redirect()->route('list.index');         // отправить на страницу с ТуДу листами
    }

    /**
     * Display the specified resource.
     * Метод show реализует отрисовку страницу с условием Where
     * записываем в переменную item,
     * @param TodoList $list
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $list)
    {
        $items = TodoItem::query()->where('todo_list_id', '=', $list->id)->get();
        return view('todo_list.show', ['list' => $list, 'items' => $items]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TodoList $list
     * @return void
     */
    public function edit(TodoList $list)
    {
        return view('todo_list.edit', ['list' => $list]);
    }

    /**
     * Update the specified resource in storage.
     * METHOD POST
     * @param \Illuminate\Http\Request $request
     * @param TodoList $list
     * @return void
     */
    public function update(Request $request, TodoList $list)
    {
        $list->name = $request->get('name');
        $list->description = $request->get('description');
        $list->save();
        return redirect()->route('list.show', ['list' => $list]);
    }

    /**
     * Remove the specified resource from storage.
     * METHOD DELETE
     * @param TodoList $list
     * @return void
     * @throws \Exception
     */
    public function destroy(TodoList $list)
    {
        $list->delete();
        return redirect()->route('list.index');
    }
}
