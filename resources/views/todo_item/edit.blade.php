@extends('layouts.app')

@section('content')
    <form action="{{route('list.item.update', ['item' => $item->id, 'list' => $list->id])}}" method="post">
        @csrf {{-- защита от крос доменных запросов (перейти по ссылке можно только с сайта) --}}
        @method('patch')
        <input type="hidden" name="todo_list_id" value="{{ $list->id }}">
        Задача <input name="text" required maxlength="256" minlength="5" value="{{ $item->text }}">
        <input type="checkbox" name="is_done"  @if ($item->is_done) checked @endif value="1"> Готово

        {{--   <div>
               <input id="input" placeholder="What needs to be done?">
           </div>--}}
        <input type="submit" value="отправить">
    </form>
@endsection
