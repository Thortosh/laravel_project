@extends('layouts.app')

@section('content')
    @if(\Session::has('message'))
        <div class="alert alert-danger" role="alert">
            {{ \Session::get('message') }}
        </div>
    @endif
    <a id="btn-remove-all" class="btn-common" href="{{ route('list.create') }}">Начать новый список</a>
    @if (count($todolists))
        <ul>
            @foreach($todolists as $list)
                @if(!$list->is_public)
                    <li> ({{ $list->items_done_count }} / {{ $list->items_count }})
                        <a id="btn-remove-all" class="btn-common"
                           href="{{ route('list.show', ['list'=>$list->id]) }}">{{$list->name}}</a>
                        (<a href="{{route('list.edit', ['list'=>$list->id])}}">Редактировать</a> )
                        <form action="{{route('list.destroy', ['list'=>$list->id])}}" method="post">
                            @method('delete')
                            @csrf               {{-- csrf токен авторизации --}}
                            <input type="submit" value="Удалить">
                        </form>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
@endsection
