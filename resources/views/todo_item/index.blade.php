@extends('layouts.app')

@section('content')
    <a id="btn-remove-all" class="btn-common" href="{{ route('item.create') }}">Создать новую задачу</a>

    @if (count($items))
        <ul>
            @foreach($items as $item)
                <li>
                    <a id="btn-remove-all" class="btn-common"
                       href="{{ route('item.show', ['item'=>$item->id]) }}">{{$item->name}}</a>
                    (<a href="{{route('item.edit', ['item'=>$item->id])}}">Редактировать</a> )
                    <form action="{{route('item.destroy', ['item'=>$item->id])}}" method="post">
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
