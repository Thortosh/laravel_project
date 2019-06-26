<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoItemsTable extends Migration
{
    /**
     * Run the migrations.
     * Для создания новой миграции использовать команду migrate:make командного интерфейса Artisan: php artisan migrate:make todo_items
     * Класс миграций содержит два метода: up() и down().
     * Метод up() используется для добавления новых таблиц, столбцов или индексов в вашу БД, а метод down() просто отменяет операции, выполненные методом up().
     * Создание таблицы todo_items
     * Столбцы: id, text, todo_list_id, is_done и timestamps
     * @return void
     */
    public function up()
    {
        Schema::create('todo_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text', 256);
            $table->bigInteger('todo_list_id');
            $table->boolean('is_done')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todo_items');
    }
}
