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
                            <input value="{{ old('email') }}" name="email"
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
                            <input name="password"
                                class="w-full py-4 text-xs placeholder-gray-400 font-semibold leading-none bg-gray-50 outline-none"
                                type="password" placeholder="Enter your password" required autocomplete="current-password">
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
                        <button type="submit"
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
                                <button style="background-color: #b95555"
                                    class="flex items-center justify-center px-3 py-3 w-full text-sm text-white font-semibold leading-none border rounded"
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
    {{-- <section class="relative py-20">
        <img class="hidden lg:block absolute top-0 left-0 mt-16" src="zeus-assets/icons/dots/blue-dot-left-bars.svg" alt="">
        <img class="hidden lg:block absolute bottom-0 right-0 mb-20"
            src="zeus-assets/icons/dots/yellow-dot-right-shield.svg" alt="">
        <div class="container px-4 mx-auto">
            <div class="max-w-md mx-auto py-6 lg:py-12 px-4 lg:px-8 bg-white border rounded-xl text-center">
                <span class="inline-block mb-4 text-xs text-blue-400 font-semibold">Sign In</span>
                <h3 class="mb-12 text-3xl font-semibold font-heading">Join our community</h3>
                <form action="#">
                    <div class="relative flex flex-wrap mb-6">
                        <input class="relative mb-2 md:mb-0 w-full py-4 pl-4 text-sm border rounded" type="email"
                            placeholder="e.g hello@shuffle.dev">
                        <span class="absolute top-0 left-0 ml-4 -mt-2 px-1 inline-block bg-white text-gray-500 text-xs">Your
                            email address</span>
                    </div>
                    <div class="relative flex flex-wrap mb-6">
                        <input class="relative mb-2 md:mb-0 w-full py-4 pl-4 text-sm border rounded" type="password"
                            placeholder="******">
                        <span
                            class="absolute top-0 left-0 ml-4 -mt-2 px-1 inline-block bg-white text-gray-500 text-xs">Password</span>
                    </div>
                    <button
                        class="w-full inline-block py-4 mb-4 text-sm text-white font-medium leading-normal bg-v-purple-300 hover:bg-v-purple-200 rounded transition duration-200">Get
                        Started</button>
                    <a class="block pb-6 mb-6 text-sm font-semibold hover:underline border-b" href="#">Forgot password?</a>
                    <a class="flex items-center justify-center mb-4 py-4 bg-blue-800 hover:bg-blue-900 rounded" href="#">
                        <span class="inline-block mr-2">
                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.0898 11.8182V6.51074H5.90537L6.17776 4.4417H4.0898V3.12092C4.0898 2.52207 4.25864 2.11397 5.13515 2.11397L6.25125 2.11352V0.262891C6.05824 0.238289 5.39569 0.181885 4.62456 0.181885C3.01431 0.181885 1.9119 1.14594 1.9119 2.91601V4.4417H0.0908203V6.51074H1.9119V11.8182H4.0898Z"
                                    fill="white"></path>
                            </svg>
                        </span>
                        <span class="text-sm text-white">Sign in with Facebook</span>
                    </a>
                    <a class="flex items-center justify-center py-4 bg-blue-400 hover:bg-blue-500 rounded" href="#">
                        <span class="inline-block mr-2">
                            <svg width="13" height="11" viewBox="0 0 13 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12.5455 2.0974C12.0904 2.29904 11.6022 2.43579 11.0892 2.49684C11.613 2.18316 12.014 1.68562 12.204 1.09459C11.7127 1.38508 11.1703 1.59601 10.5924 1.71035C10.1296 1.21667 9.47138 0.90918 8.74128 0.90918C7.34059 0.90918 6.20489 2.04488 6.20489 3.4448C6.20489 3.64334 6.2273 3.83726 6.27057 4.0227C4.16298 3.91684 2.29411 2.90708 1.0433 1.37272C0.824652 1.74665 0.700269 2.18237 0.700269 2.64748C0.700269 3.52746 1.14837 4.30391 1.82825 4.75817C1.41259 4.74427 1.02166 4.62993 0.67942 4.43987V4.47154C0.67942 5.69995 1.55399 6.72516 2.71362 6.95849C2.50116 7.01567 2.27712 7.04734 2.04534 7.04734C1.88156 7.04734 1.72318 7.03112 1.56788 7.00021C1.89081 8.00843 2.8272 8.74161 3.93663 8.76171C3.06902 9.44159 1.97504 9.84565 0.786814 9.84565C0.582087 9.84565 0.38043 9.83328 0.181885 9.81088C1.30445 10.5317 2.63716 10.952 4.06952 10.952C8.73514 10.952 11.2854 7.08752 11.2854 3.73607L11.2769 3.40773C11.7752 3.05231 12.2063 2.60577 12.5455 2.0974Z"
                                    fill="white"></path>
                            </svg>
                        </span>
                        <span class="text-sm text-white">Sign in with Twitter</span>
                    </a>
                </form>
            </div>
        </div>
    </section>
    <section class="relative py-20">
        <img class="hidden lg:block absolute top-0 left-0 mt-16" src="zeus-assets/icons/dots/blue-dot-left-bars.svg" alt="">
        <img class="hidden lg:block absolute bottom-0 right-0 mb-20"
            src="zeus-assets/icons/dots/yellow-dot-right-shield.svg" alt="">
        <div class="container px-4 mx-auto">
            <div class="max-w-md mx-auto py-6 lg:py-12 px-4 lg:px-8 bg-white border rounded-xl text-center">
                <span class="inline-block mb-4 text-xs text-blue-400 font-semibold">Sign Up</span>
                <h3 class="mb-12 text-3xl font-semibold font-heading">Create new account</h3>
                <form action="#">
                    <div class="flex flex-wrap -mx-2">
                        <div class="relative w-full lg:w-1/2 px-2 flex flex-wrap mb-6">
                            <input class="relative mb-2 md:mb-0 w-full py-4 pl-4 text-sm border rounded" type="text"
                                placeholder="John">
                            <span
                                class="absolute top-0 left-0 ml-4 -mt-2 px-1 inline-block bg-white text-gray-500 text-xs">First
                                name</span>
                        </div>
                        <div class="relative w-full lg:w-1/2 px-2 flex flex-wrap mb-6">
                            <input class="relative mb-2 md:mb-0 w-full py-4 pl-4 text-sm border rounded" type="text"
                                placeholder="Smith">
                            <span
                                class="absolute top-0 left-0 ml-4 -mt-2 px-1 inline-block bg-white text-gray-500 text-xs">Last
                                name</span>
                        </div>
                    </div>
                    <div class="relative flex flex-wrap mb-6">
                        <input class="relative mb-2 md:mb-0 w-full py-4 pl-4 text-sm border rounded" type="email"
                            placeholder="e.g hello@shuffle.dev">
                        <span
                            class="absolute top-0 left-0 ml-4 -mt-2 px-1 inline-block bg-white text-gray-500 text-xs">Email
                            address</span>
                    </div>
                    <div class="relative flex flex-wrap mb-6">
                        <input class="relative mb-2 md:mb-0 w-full py-4 pl-4 text-sm border rounded" type="password"
                            placeholder="********">
                        <span
                            class="absolute top-0 left-0 ml-4 -mt-2 px-1 inline-block bg-white text-gray-500 text-xs">Password</span>
                    </div>
                    <label class="inline-flex mb-10 text-left">
                        <input class="mr-2" type="checkbox" name="terms" value="1">
                        <span class="-mt-1 inline-block text-sm text-gray-500">By signing up, you agree to our <a
                                class="text-red-400 hover:underline" href="#">Terms, Data Policy</a> and <a
                                class="text-red-400 hover:underline" href="#">Cookies Policy</a>.</span>
                    </label>
                    <button
                        class="w-full inline-block py-4 mb-4 text-sm text-white font-medium leading-normal bg-v-purple-300 hover:bg-v-purple-200 rounded transition duration-200">Sign
                        up</button>
                </form>
                <p class="text-sm text-gray-500">
                    <span>Already have an account?</span>
                    <a class="text-red-400 font-semibold hover:underline" href="#">Sign in</a>
                </p>
            </div>
        </div>
    </section> --}}
@endsection

@section('scripts')
    <script>

    </script>
@endsection
