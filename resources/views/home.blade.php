@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <li>
                            <a href="{{ route('list.index') }}">My todos</a>
                        </li>
                        <li>
{{--                            @dd(\App\TodoList::is_public())--}}
{{--                            @dd(route('list.public'))--}}
                            <a href="{{ route('public.index')  }}">Public todos</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
