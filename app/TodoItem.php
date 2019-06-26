<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TodoItem
 * @package App
 * реализация тонкой модели
 * @property $text
 * @property $todo_list_id
 * @property $is_done
 * @property $created_at
 * @property $updated_at
 * @property $id
 */
class TodoItem extends Model
{
    protected $table = 'todo_items';                                // имя таблицы
    protected $fillable = ['text', 'todo_list_id', 'is_done'];      // Список полей которые мы можем заполнять сами
}
