@extends('layouts.app')
@section('content')
    <a href="{{ route('list.index') }}"> &lt; Назад </a>
    <ul>
        <li>
            Название: {{$list->name}}
        </li>
        <li>
            Описание: {{$list->description}}
        </li>
    </ul>
    <a href="{{ route('list.item.create', ['list' => $list->id]) }}">Добавить задачу</a>
    @if ($list->items->count())
        <ul>

            @foreach($list->items as $item)
                <li>
                    {{--                    ({{ $item->is_done ? 'Готово' : 'Не готово' }})--}}
                    <i class="fas @if ($item->is_done) fa-check @else fa-times @endif"></i>
                    <a id="btn-remove-all" class="btn-common"
                       href="{{ route('list.item.show', ['item'=>$item->id, 'list'=>$list->id ]) }}">{{$item->text}}</a>
                    (<a href="{{route('list.item.edit', ['item'=>$item->id, 'list'=>$list->id ])}}">Редактировать</a> )
                    <form action="{{route('list.item.destroy', ['item'=>$item->id, 'list'=>$list->id ])}}"
                          method="post">
                        @method('delete')
                        @csrf
                        <input type="submit" value="Удалить">
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        Список пуст
    @endif
@endsection
