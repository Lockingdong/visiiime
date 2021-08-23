@extends('components.web.layouts.main')


@section('style')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>

</style>
@endsection

@section('content')
<div>

    @include('components.web.layouts.errors')

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            {{--
                1. name 請幫我帶email @的前半部

                ex.
                test1234@gmail.com => test1234

                2. type 改為hidden
            --}}
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div>
            <input type="text" type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <input id="password" type="password" name="password" required autocomplete="new-password" />
        </div>
        <div>
            <input id="password_confirmation" type="password" name="password_confirmation" required />
        </div>

        <div>
            <a href="{{ route('login') }}">已註冊過帳號 ?</a>
            <button>註冊</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>

</script>
@endsection
