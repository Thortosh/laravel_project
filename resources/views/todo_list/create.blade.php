@extends('layouts.app')

@section('content')
<form action="{{route('list.store')}}" method="post">
    @csrf {{-- защита от крос доменных запросов (перейти по ссылке можно только с сайта) --}}
    <div>
        Название <input name="name" required maxlength="64" minlength="5">
    </div>
    <div>
        Описание <input name="description" maxlength="256" minlength="0">
    </div>
 {{--   <div>
        <input id="input" placeholder="What needs to be done?">
    </div>--}}
    <input type="submit" value="отправить">
</form>
@endsection
