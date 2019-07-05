<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TodoList
 * @package App
 * @property $name
 * @property $description
 * @property $user_id
 * @property $updated_at
 * @property $created_at
 * @property $is_public
 * @property $id
 * Тонкая модель толстый контроллер
 * Реализация тонкой модели Todolist
 *

 */
class TodoList extends Model
{

    /**
     * @var string
     * протектед свойство $table содержит имя таблицы todo_lists
     * протектед свойство $fillable содержит список полей которые мы можем заполнять сами
     */
    protected $table = 'todo_lists';                                // имя таблицы
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'is_public'
    ];       // Список полей которые мы можем заполнять сами

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     *
     * $this->hasMany - отношение «один ко многим» используется для определения отношений, где одна модель владеет некоторым количеством других моделей.
     * Примером отношения «один ко многим» является статья в блоге, которая имеет «много» комментариев.
     * Как и другие отношения Eloquent вы можете смоделировать это отношение таким образом.
     * Метод items возвращает отношение таблицы todo_lists (столбец id) к todo_item (столбец todo_list_id)
     * hasMany принимает три аргумента:
     * App\TodoItem - модель
     * todo_list_id - имя столбца таблицы привязанной к модели App\TodoItem
     * id - имя столбца таблицы App\TodoList
     */
    public function items()
    {
        return $this->hasMany('App\TodoItem', 'todo_list_id', 'id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * Метод items_done проверяет установленное значение в столбце is_done(таблицы todo_items)
     */
    public function items_done()
    {
        return $this->items()->where('is_done', true);
    }

    public function getIsDoneAttribute() // camelCase snake_case UpCamelCase
    {
        return $this->items->count() && $this->items->count() == $this->items_done->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * Возвращаем результат запроса 'SELECT * FROM todo_lists WHERE is_public = true
     */
    public static function is_public()
    {
//        dd(self::query()->where('is_public', true));
        return self::query()->where('is_public', '=', true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * Метоод my дергает из модели id пользователя (возвращает id авторизованного пользователя)
     */
    public static function my()
    {
        return self::query()->where('user_id', \Auth::user()->id);
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
