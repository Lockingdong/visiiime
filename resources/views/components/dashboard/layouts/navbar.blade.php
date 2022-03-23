<section>
    <div class="bg-white w-full px-4 mx-auto z-10 py-4 top-0 left-0">
        <nav class="relative">
            <div class="flex justify-between items-center">
                <a class="text-lg font-medium" href="/">
                    <img class="h-6" src="/dashboard/visiiime-assets/logo/logo-purple.png" alt="" width="auto">
                </a>
                <div>
                    <button class="navbar-burger flex items-center p-3 hover:bg-gray-50 rounded">
                        <svg class="block h-4 w-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Mobile menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
    </div>
    <div class="hidden navbar-menu relative z-50">
        <div class="navbar-backdrop fixed inset-0 bg-gray-800 opacity-25"></div>
        <nav
            class="fixed top-0 left-0 bottom-0 flex flex-col w-5/6 max-w-sm py-6 px-6 bg-white overflow-y-auto">
            <div class="flex items-center mb-8">
                <a class="mr-auto text-2xl font-medium leading-none" href="/">
                    <img class="h-6" src="/dashboard/visiiime-assets/logo/logo-purple.png" alt="" width="auto">
                </a>
                <button class="navbar-close">
                    <svg class="h-6 w-6 text-gray-500 cursor-pointer hover:text-gray-500"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div>
                <ul>
                    <li class="mb-1">
                        <a class="block p-4 text-sm font-medium text-gray-900 hover:bg-gray-50 rounded">
                            <span class="text-sm inline-block">{{ Auth::user()->name }}</span>
                        </a>
                    </li>
                    <li class="mb-1 cursor-pointer">
                        <form method="POST" action="{{ route('logout') }}" class="block p-4 text-sm font-medium text-gray-900 hover:bg-gray-50 rounded">
                            @csrf
                            <a class="cursor-pointer" :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                登出
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
            <div class="mt-auto">
                <div class="pt-6">
                    {{-- @if (Route::has('login'))
                        @auth
                            <a
                            class="block py-3 text-sm text-center text-white leading-normal rounded bg-v-purple-300 hover:bg-v-purple-200 font-medium transition duration-200"
                            href="{{ url('/v-dashboard') }}">我的後台</a>
                        @else
                            <a
                            class="block mb-2 py-3 text-sm text-center leading-normal rounded border font-medium"
                            href="{{ route('login') }}">登入</a>
                            @if (Route::has('register'))
                                <a
                                class="block py-3 text-sm text-center text-white leading-normal rounded bg-v-purple-300 hover:bg-v-purple-200 font-medium transition duration-200"
                                href="{{ route('register') }}">註冊</a>
                            @endif
                        @endauth
                    @endif --}}
                </div>
                <p class="mt-6 mb-4 text-sm text-center text-gray-500">
                    <span>© 2021 All rights reserved.</span>
                </p>
            </div>
        </nav>
    </div>
</section>
