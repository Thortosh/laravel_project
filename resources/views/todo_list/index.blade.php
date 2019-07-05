@extends('layouts.app')

@section('content')
    @if(\Session::has('message'))
        <div class="alert alert-danger" role="alert">
            {{ \Session::get('message') }}
        </div>
    @endif
    <a id="btn-remove-all" class="btn btn-primary" href="{{ route('list.create') }}">Начать новый список</a>
    @if (count($todolists))
        <ul>
            @foreach($todolists as $list)
                <div class="card" style="width: 18rem;">
                    <li>
                        <pan class="btn btn-primary">({{ $list->items_done_count }} / {{ $list->items_count }})</pan>

                        <a class="card-title" id="btn-remove-all" class="btn-common"
                           href="{{ route('list.show', ['list'=>$list->id]) }}">{{$list->name}}</a>
                    </li>
                </div>
                <a class="fas fa-edit" href="{{route('list.edit', ['list'=>$list->id])}}">Редактировать</a>

                <form class="form-inline my-2 my-lg-0" action="{{route('list.destroy', ['list'=>$list->id])}}" method="post">
                    @method('delete')
                    @csrf               {{-- csrf токен авторизации --}}
                    <input class="form-inline my-2 my-lg-0" type="submit" value="Удалить">
                </form>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
