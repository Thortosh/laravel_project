@extends('layouts.app')
@section('content')

    <a class="fas fa-backward" href="{{ route('home') }}"> Назад </a>
    {{--    @dd($user)--}}
    <ul>
        <li>
            Full name:
        </li>
        <li>
            Nickname: {{ $user->name }} <a class="" href="{{ route('user.edit', ['user' => $user]) }}"> edit </a>
        </li>
        <li>
            Phone:
        </li>
        <li>
            About:
        </li>
        <li>
            Email: {{ $user->email }}
        </li>
        <li>
            Created: {{ $user->created_at}}
        </li>
    </ul>



@endsection
