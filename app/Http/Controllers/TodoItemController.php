<?php

namespace App\Http\Controllers;

use App\TodoItem;
use App\TodoList;
use Illuminate\Http\Request;

class TodoItemController extends Controller
{
    /**
     * Чтобы посмотеть на TodoItemIndex откройте TodoListController::show
     */

    /**
     * Show the form for creating a new resource.
     *
     * @param TodoList $list
     * @return \Illuminate\Http\Response
     */
    public function create(TodoList $list)
    {
        return view('todo_item.create', ['list' => $list]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param TodoList $list
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TodoList $list)
    {
        if ($list->id != $request->get('todo_list_id')) {
            return redirect()->back();
        }

        TodoItem::query()->create([
            'text' => $request->get('text'),
            'is_done' => (bool)$request->get('is_done'),
            'todo_list_id' => $request->get('todo_list_id')
        ]);

        return redirect()->route('list.show', ['list' => $list->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param TodoList $list
     * @param TodoItem $item
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $list, TodoItem $item)
    {
        return view('todo_item.show', ['item' => $item, 'list' => $list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TodoList $list
     * @param TodoItem $item
     * @return \Illuminate\Http\Response
     */
    public function edit(TodoList $list, TodoItem $item)
    {
        return view('todo_item.edit', ['item' => $item, 'list' => $list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param TodoList $list
     * @param TodoItem $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoList $list, TodoItem $item)
    {

        if ($list->id != $request->get('todo_list_id')) {
            return redirect()->back();
        }

        $item->update([
            'text' => $request->get('text'),
            'is_done' => (bool)$request->get('is_done'),
        ]);

        return redirect()->route('list.show', ['list' => $list->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param TodoList $list
     * @param TodoItem $item
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(TodoList $list, TodoItem $item)
    {
        $item->delete();
        return redirect()->route('list.show', ['list' => $list->id]);
    }
}
