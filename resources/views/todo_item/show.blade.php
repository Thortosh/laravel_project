@extends('layouts.app')
@section('content')

     <a href="{{ route('list.show', ['list'=>$list->id]) }}"> &lt; Назад </a>
     Из списка {{ $list->name }}

     <ul>
        <li>
            Название: {{$item->text}}
        </li>
        <li>
            Описание: {{$item->is_done ? 'Готово' : 'Не готово'}}
        </li>
    </ul>


@endsection
