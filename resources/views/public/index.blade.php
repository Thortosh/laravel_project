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
                {{--                @if($list->is_public)--}}

                {{--                @dd($list)--}}
                {{--                @dd($list->is_public)--}}
                {{--                @if($list->is_public = 'Yes')--}}
                <li> ({{ $list->items_done_count }} / {{ $list->items_count }})
                    @can('view', $list)
                        <a id="btn-remove-all" class="btn-common"
                           href="{{ route('list.show', ['list'=>$list->id]) }}">{{$list->name}}</a>
                    @endcan

                    {{--                    @dd(Request::user())  текущий юзер  --}}
                    {{--                    @dd({{$list->user_id}}) id создателя туду--}}
                    @if(Request::user()->id == $list->user_id)
                        @can('update', $list)
                            (<a href="{{route('list.edit', ['list'=>$list->id])}}"> Редактировать </a> )
                        @endcan
                    @else()
                        ( <a href="{{route('public.copy', ['list'=>$list->id])}}"> Копировать задчи к себе </a> )
                    @endif
                    {{($list->user->name)}}
                    @can('delete', $list)
                        <form action="{{route('list.destroy', ['list'=>$list->id])}}" method="post">
                            @method('delete')
                            @csrf               {{-- csrf токен авторизации--}}
                            <input type="submit" value="Удалить">
                        </form>
                    @endcan
                    <ul>
                        @foreach($list->items as $item)
                            <li>{{ $item->text }}</li>
                        @endforeach
                    </ul>
                </li>
                {{--                @endif--}}
            @endforeach
        </ul>
    @endif
@endsection
