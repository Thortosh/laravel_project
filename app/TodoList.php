<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TodoList
 * @package App
 * реализация тонкой модели
 * @property $name
 * @property $description
 * @property $user_id
 * @property $updated_at
 * @property $created_at
 * @property $id
 */
class TodoList extends Model
{
    protected $table = 'todo_lists';                                // имя таблицы
    protected $fillable = ['user_id', 'name', 'description'];       // Список полей которые мы можем заполнять сами
}
