@extends('components.web.layouts.main')


@section('style')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>

</style>
@endsection

@section('content')
<div>
    @include('components.web.layouts.errors')

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus />
        </div>

        <!-- Password -->
        <div>
            <input type="password" name="password" required autocomplete="current-password" />
        </div>

        <div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">忘記密碼</a>
            @endif

            <a href="">google</a>

            <a href="{{ url('/auth/redirect/facebook') }}">facebook</a>

            <button>登入</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
