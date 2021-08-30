@extends('components.web.layouts.main')


@section('style')
    <style>

    </style>
@endsection

@section('content')
<div class="antialiased bg-body text-body font-body">
    <form method="POST" class="py-12" action="{{ route('login') }}">
        @csrf
        <div class="container px-4 mx-auto">
            <div class="rounded-xl border flex flex-col max-w-md mx-auto text-center px-5">
                <div class="my-12 mb-8 md:mb-12">
                    <span class="text-sm text-gray-400"></span>
                    <h4 class="mb-6 text-3xl">登入帳戶</h4>
                    <div class="flex mb-4 px-4 bg-gray-50 rounded">
                        <input
                            value="{{ old('email') }}"
                            name="email"
                            class="w-full py-4 text-xs placeholder-gray-400 font-semibold leading-none bg-gray-50 outline-none"
                            type="email" placeholder="name@email.com" required autofocus>

                        <svg class="h-6 w-6 ml-4 my-auto text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                            </path>
                        </svg>
                    </div>
                    <div class="flex mb-6 px-4 bg-gray-50 rounded">
                        <input
                            name="password"
                            class="w-full py-4 text-xs placeholder-gray-400 font-semibold leading-none bg-gray-50 outline-none"
                            type="password" placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                            >
                        <button class="ml-4">
                            <svg class="h-6 w-6 my-auto text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <button
                        type="submit"
                        class="block w-full p-3 text-center text-sm text-white font-semibold leading-none bg-indigo-600 hover:bg-indigo-700 rounded">登入</button>
                        <p class="my-6 text-xs text-gray-400 text-center">
                            @if (Route::has('password.request'))
                                <a class="underline hover:text-gray-500" href="{{ route('password.request') }}">忘記密碼</a>
                            @endif
                        </p>
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 md:py-4 md:mb-0 md:pr-1">
                            <a style="background-color: #436dbc"
                                class="flex items-center justify-center w-full px-3 py-3 mb-2 text-sm text-white font-semibold leading-none border rounded"
                                href="{{ url('/auth/redirect/facebook') }}">
                                <span>Facebook 登入</span>
                            </a>
                        </div>
                        <div class="w-full md:w-1/2 md:py-4 mb-4 md:mb-0 md:pl-1">
                            <button style="background-color: #b95555" class="flex items-center justify-center px-3 py-3 w-full text-sm text-white font-semibold leading-none border rounded"
                                href="#">
                                <span>Google 登入</span>
                            </button>
                        </div>
                    </div>
                    <div>
                        @include('components.web.layouts.errors')
                    </div>
                </div>
                <div class="mb-5">
                    <p class="text-xs text-gray-400 text-center"><a class="underline hover:text-gray-500"
                            href="{{ route('register') }}">還沒有帳號 ?</a></p>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
