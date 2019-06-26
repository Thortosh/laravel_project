<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodoListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * Для создания новой миграции использовать команду migrate:make командного интерфейса Artisan: php artisan migrate:make todo_lists
     * Класс миграций содержит два метода: up() и down().
     * Метод up() используется для добавления новых таблиц, столбцов или индексов в вашу БД, а метод down() просто отменяет операции, выполненные методом up().
     * Создание таблицы todo_list
     * Столбцы: id, name, description и timestamps
     */
    public function up()
    {
        Schema::create('todo_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
            $table->string('name', 64);
            $table->string('description', 256)->nullable();
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
        Schema::dropIfExists('todo_lists');
    }
}
