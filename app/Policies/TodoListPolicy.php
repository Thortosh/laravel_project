<?php

namespace App\Policies;

use App\User;
use App\TodoList;
use Illuminate\Auth\Access\HandlesAuthorization;

class TodoListPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any todo lists.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the todo list.
     * Метод view - проверяет и отрисовывает нужную страницу
     * @param  \App\User  $user
     * @param  \App\TodoList  $todoList
     * @return mixed
     *
     *
     */
    public function view(User $user, TodoList $todoList)
    {
        // boolean. если страница публичная возращаем true. Проверяем яляется ли юзер создателем туду листа
        return $todoList->is_public || $todoList->user_id == $user->id;
    }

    /**
     * Determine whether the user can create todo lists.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the todo list.
     *
     * @param  \App\User  $user
     * @param  \App\TodoList  $todoList
     * @return mixed
     */
    public function update(User $user, TodoList $todoList)
    {
        //  @if(Request::user()->id == $list->user_id)
        return $todoList->user_id == $user->id;

    }

    /**
     * Determine whether the user can update the todo list.
     *
     * @param  \App\User  $user
     * @param  \App\TodoList  $todoList
     * @return mixed
     */
    public function edit(User $user, TodoList $todoList)
    {
        return $todoList->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the todo list.
     *
     * @param  \App\User  $user
     * @param  \App\TodoList  $todoList
     * @return mixed
     */
    public function delete(User $user, TodoList $todoList)
    {
        return $todoList->user_id == $user->id;
    }
}
