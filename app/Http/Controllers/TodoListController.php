<?php

namespace App\Http\Controllers;

use App\TodoItem;
use App\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(TodoList::class, 'list');
    }

    /**
     * Store a newly created resource in storage.
     * METHOD POST
     * Метод store обрабатывает и сохраняет переданные данные
     *
     * $list - создаем объект класса модели TodoList
     *
     * В свойство $list->name(свойство name создается в нутри объекта list) записываем введенное пользователем имя списка
     * В свойство $list->description(свойство description создается в нутри объекта list) записываем введенное пользователем описание списка
     * В свойство  $list->user_id записываем в свойство user_id данные аутентификации (Auth::user()->id - получаем из текущей сессии user, и получаем его id)
     *
     * сохраняем модель
     * редиректим пользователя на страницу с туду листами (list.index)
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
        return redirect()->route('list.index');
    }

    /**
     * Display a listing of the resource.
     * Возвращем полученные данные
     * В переменную todolist записываем данные из модели (TodoList::my() - возвращает id авторизованного пользователя.)
     * withCount - посчитать число результатов отношения, не загружая их, используйте. который поместит столбец {relation}_count в вашу результирующую модель.
     * get - выполняет sql запрос SELECT
     * return Отрисовываем страницу todo_list.index с переданными данными todolists
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
//        dd(\request());
//        if (!\Auth::user())
        $todolists = TodoList::my()->withCount(['items', 'items_done'])->get();
        return view('todo_list.index', ['todolists' => $todolists]);
    }

    /**
     * Show the form for creating a new resource.
     * METHOD GET
     *
     * Метод create показывает странцу с формой для заполнения имени и описания To Do листа
     * @return void
     *
     */
    public function create()
    {
        return view('todo_list.create');
    }

    /**
     * Display the specified resource.
     * METHOD GET
     *
     * Метод show реализует отрисовку страницу с условием Where где todo_list_id(список задач) =
     * записываем в переменную item,
     *
     * load - Ленивая нетерпеливая загрузка
     * @param TodoList $list
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(TodoList $list)
    {
        $list->load(['items']);
//        $list->items = TodoItem::query()->where('todo_list_id', '=', $list->id)->get();
        return view('todo_list.show', ['list' => $list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TodoList $list
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
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
//        альтернативная запись
//        $list->name = $request->get('name');
//        $list->description = $request->get('description');
//        $list->is_public = (boolean)$request->get('is_public', false);
//        $list->save();

        $list->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'is_public' => !(boolean)$request->get('is_public'),
        ]);
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
