@extends('layouts.app')

@section('content')
    @if(\Session::has('message'))
        <div class="alert alert-danger" role="alert">
            {{ \Session::get('message') }}
        </div>
    @endif
    {{--    <a id="btn-remove-all" class="btn-common" href="{{ route('list.create') }}">Начать новый список</a>--}}
    @if (count($todolists))
        <ul>
            @foreach($todolists as $list)
                <div class="card" style="width: 350px">
                    <div class="card-body">
                        <span class="card-title">
                            <span class="badge
                                @if ($list->items_done_count < $list->items_count)
                                badge-primary
                                @elseif ($list->items_count == 0)
                                badge-secondary
                                @elseif ($list->items_done_count == $list->items_count)
                                badge-success
                                @endif
                                ">
                                ({{ $list->items_done_count }} / {{ $list->items_count }})
                            </span>
                            <a href="{{ route('list.show', ['list'=>$list->id]) }}">{{$list->name}}</a>
                            <span class="d-inline float-right">
                                @if(Request::user()->id == $list->user_id)
                                    @can('update', $list)
                                        <a class="fas fa-edit btn btn-primary" size="5"
                                           href="{{route('list.edit', ['list'=>$list->id])}}"> </a>
                                    @endcan
                                @else()
                                    <a class="btn btn-success far fa-copy"
                                       href="{{route('public.copy', ['list'=>$list->id])}}"></a>
                                @endif

                                @can('delete', $list)
                                    <form class="form-inline p0 float-right"
                                          action="{{route('list.destroy', ['list'=>$list->id])}}"
                                          method="post">
                                        @method('delete')
                                        @csrf               {{-- csrf токен авторизации--}}
                                        <button class="btn btn-danger" type="submit">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endcan

                            </span>
                        </span>
                        <div class="card-text">
                            автор: {{($list->user->name)}}
                        </div>

                        <ul class="list-group">
                            @foreach($list->items as $item)
                                <li class="list-group-item">{{ $item->text }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </ul>
    @endif
@endsection
