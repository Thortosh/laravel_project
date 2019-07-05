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
                            <a href="{{ route('public.index')  }}">Public todos</a>
                        </li>
                        <li>
                            <a href="{{ route('user.me')  }}">My profile</a>
                        </li>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
