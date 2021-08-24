@extends('components.web.layouts.main')


@section('style')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        div {
            color: red;
        }
        
    </style>
@endsection

@section('content')

    @if (Route::has('login'))
        @auth
            <a href="{{ url('/dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Log in</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    @endif

    html here
    <div>
        home content here 123
    </div>

@endsection

@section('scripts')
    <script>
        // js here
        alert();
    </script>
@endsection
