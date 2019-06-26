@extends('layouts.app')

@section('content')
    <a id="btn-remove-all" class="btn-common" href="{{ route('list.create') }}">Начать новый список</a>

    @if (count($todolists))
        <ul>
            @foreach($todolists as $list)
                <li>
                    <a id="btn-remove-all" class="btn-common"
                       href="{{ route('list.show', ['list'=>$list->id]) }}">{{$list->name}}</a>
                    (<a href="{{route('list.edit', ['list'=>$list->id])}}">Редактировать</a> )
                    <form action="{{route('list.destroy', ['list'=>$list->id])}}" method="post">
                        @method('delete')
                        @csrf
                        <input type="submit" value="Удалить">
                    </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
