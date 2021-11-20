@extends('components.web.layouts.main')


@section('style')
<style>

</style>
@endsection

@section('content')
<section class="relative py-20">
    @include('components.web.layouts.errors')
    <div class="container px-4 mx-auto">
        <div class="max-w-md mx-auto py-6 lg:py-12 px-4 lg:px-8 bg-white border rounded-xl text-center">
            <span class="inline-block mb-4 text-xs text-blue-400 font-semibold">Sign Up</span>
            <h3 class="mb-12 text-3xl font-semibold font-heading">註冊</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="relative flex flex-wrap mb-6">
                    <input value="{{ old('email') }}" class="relative mb-2 md:mb-0 w-full py-4 pl-4 text-sm border rounded" type="email"
                        placeholder="visiiime@visiiime.com"
                        required
                        name="email"
                        >
                    <span
                        class="absolute top-0 left-0 ml-4 -mt-2 px-1 inline-block bg-white text-gray-500 text-xs">Email
                        </span>
                </div>
                <div class="relative flex flex-wrap mb-6">
                    <input name="password" class="relative mb-2 md:mb-0 w-full py-4 pl-4 text-sm border rounded" type="password"
                        placeholder="********" required>
                    <span
                        class="absolute top-0 left-0 ml-4 -mt-2 px-1 inline-block bg-white text-gray-500 text-xs">密碼</span>
                </div>
                <div class="relative flex flex-wrap mb-6">
                    <input name="password_confirmation" class="relative mb-2 md:mb-0 w-full py-4 pl-4 text-sm border rounded" type="password"
                        placeholder="********" required>
                    <span
                        class="absolute top-0 left-0 ml-4 -mt-2 px-1 inline-block bg-white text-gray-500 text-xs">再次確認密碼</span>
                </div>
                <label class="inline-flex mb-10 text-left">
                    <input name="checked" value="checked" required class="mr-2" type="checkbox">
                    <span class="-mt-1 inline-block text-sm text-gray-500 text-left">我同意Visiiime的 <a
                            class="text-red-400 hover:underline" href="{{ route('terms') }}">服務條款</a> 及 <a
                            class="text-red-400 hover:underline" href="{{ route('privacy') }}">隱私權政策</a>。</span>
                </label>
                <button
                    class="w-full inline-block py-4 mb-4 text-sm text-white font-medium leading-normal bg-v-purple-300 hover:bg-v-purple-200 rounded transition duration-200">註冊</button>
                <div class="block pb-6 mb-6 text-sm font-semibold hover:underline border-b"></div>
                <a href="{{ url('/auth/redirect/facebook') }}" class="flex items-center justify-center mb-4 py-4 bg-blue-800 hover:bg-blue-900 rounded">
                    <span class="inline-block mr-2">
                        <i class="fab fa-facebook text-white"></i>
                    </span>
                    <span class="text-sm text-white">Facebook</span>
                </a>
                <a class="flex items-center justify-center py-4 bg-pink-500 hover:bg-pink-600 rounded" href="#">
                    <span class="inline-block mr-2">
                        <i class="fab fa-google text-white"></i>
                    </span>
                    <span class="text-sm text-white">Google</span>
                </a>
            </form>
            <p class="text-sm text-gray-500 mt-5">
                <span>已經是Visiiime的會員了嗎</span>
                <a class="text-red-400 font-semibold hover:underline" href="{{ route('login') }}">登入</a>
            </p>
        </div>
    </div>
</section>
{{-- <div class="antialiased bg-body text-body font-body">
    <form method="POST" action="{{ route('register') }}" class="py-12">
        @csrf

        <div class="container px-4 mx-auto">
            <div class="rounded-xl border flex flex-col max-w-md mx-auto px-5">
                <div class="my-12 mb-8 md:mb-12 ">
                    <span class="text-sm text-gray-400"></span>
                    <h4 class="mb-6 text-3xl text-center">建立新帳戶</h4>
                    <div class="flex mb-4 px-4 bg-gray-50 rounded">
                        <input value="{{ old('email') }}" name="email" class="w-full py-4 text-xs placeholder-gray-400 font-semibold leading-none bg-gray-50 outline-none" type="email" placeholder="name@email.com" required autofocus>
                        <svg class="h-6 w-6 ml-4 my-auto text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                            </path>
                        </svg>
                    </div>
                    <div class="flex mb-6 px-4 bg-gray-50 rounded">
                        <input name="password" class="w-full py-4 text-xs placeholder-gray-400 font-semibold leading-none bg-gray-50 outline-none" type="password" placeholder="請輸入您的密碼" required autocomplete="current-password">
                        <button class="ml-4">
                            <svg class="h-6 w-6 my-auto text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex mb-6 px-4 bg-gray-50 rounded">
                        <input name="password_confirmation" class="w-full py-4 text-xs placeholder-gray-400 font-semibold leading-none bg-gray-50 outline-none" type="password" placeholder="請再次輸入您的密碼" required>
                        <button class="ml-4">
                            <svg class="h-6 w-6 my-auto text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <div class="mb-6">
                        <label class="text-gray-400 flex">
                            <input type="checkbox" name="checked" value="checked">
                            <span class="text-xs text-blueGray-400 text-left pl-2">我同意遵守本公司的服務條款及隱私權政策。</span>
                        </label>
                    </div>
                    <button type="submit" class="mb-10 md:mb-8 block w-full p-3 text-center text-sm text-white font-semibold leading-none bg-indigo-600 hover:bg-indigo-700 rounded">立即註冊</button>

                    <hr class="mb-5">
                    <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 md:py-4 md:mb-0 md:pr-1">
                            <a style="background-color: #436dbc" class="flex items-center justify-center w-full px-3 py-3 mb-2 text-sm text-white font-semibold leading-none border rounded" href="{{ url('/auth/redirect/facebook') }}">
                                <span>Facebook 登入</span>
                            </a>
                        </div>
                        <div class="w-full md:w-1/2 md:py-4 mb-4 md:mb-0 md:pl-1">
                            <button style="background-color: #b95555" class="flex items-center justify-center px-3 py-3 w-full text-sm text-white font-semibold leading-none border rounded" href="#">
                                <span>Google 登入</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <p class="text-xs text-gray-400 text-center"><a class="underline hover:text-gray-500" href="{{ route('login') }}">已有帳號 ?</a></p>
                </div>
            </div>
        </div>
    </form>
</div> --}}
@endsection

@section('scripts')
<script>

</script>
@endsection
