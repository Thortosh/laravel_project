<?php

namespace App\Http\Controllers;

use App\TodoItem;
use App\TodoList;
use Illuminate\Http\Request;

class TodoPublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todolists = TodoList::is_public()->with(['items', 'user'])->withCount(['items', 'items_done'])->get();
//        $is_public = TodoList::is_public()->get();
        return view('public.index', [/*'is_public' => $is_public,*/ 'todolists' => $todolists]);
    }

    public function copy(TodoList $list)
    {
        $new_list = TodoList::query()->create([
            'user_id' => \Auth::id(),
            'name' => $list->name,
            'description' => $list->description,
            'is_public' => $list->is_public
        ]);
        $list->load('items');
        foreach ($list->items as $item) {
            TodoItem::query()->create([
                'text' => $item->text,
                'todo_list_id' => $new_list->id,
                'is_done' => $item->is_done
            ]);
        }
        return redirect()->route('public.index');
    }


}
