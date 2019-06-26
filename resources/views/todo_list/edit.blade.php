@extends('layouts.app')

@section('content')
<form action="{{route('list.update', ['list' => $list->id])}}" method="post">
    @csrf {{-- защита от крос доменных запросов (перейти по ссылке можно только с сайта) --}}
    @method('patch')
    <div>
        Название <input  name="name" required maxlength="64" minlength="5" value="{{$list->name}}" >
    </div>
    <div>
        Описание <input name="description" maxlength="256" minlength="0" value="{{$list->description}}">
    </div>
 {{--   <div>
        <input id="input" placeholder="What needs to be done?">
    </div>--}}
    <input type="submit" value="отправить">
</form>
@endsection
