@extends('layouts.app')

@section('content')
    <form action="{{route('list.item.store', ['list' => $list])}}" method="post">
        @csrf {{-- защита от крос доменных запросов (перейти по ссылке можно только с сайта) --}}
        <div>
            <input type="hidden" name="todo_list_id" value="{{ $list->id }}">
            Задача <input name="text" required maxlength="256" minlength="5">
            <input type="checkbox" name="is_done" value="1"> Готово
        </div>
        {{--   <div>
               <input id="input" placeholder="What needs to be done?">
           </div>--}}
        <input type="submit" value="отправить">
    </form>
@endsection
