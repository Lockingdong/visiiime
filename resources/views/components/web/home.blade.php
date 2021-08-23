@extends('components.web.layouts.main')


@section('style')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>

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

    <div>
        home content here
    </div>

@endsection

@section('scripts')
    <script></script>
@endsection
