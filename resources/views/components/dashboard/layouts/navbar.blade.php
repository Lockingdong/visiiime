<div class="navbar mb-2 shadow bg-white text-neutral-content">
    
    <div class="px-2 mx-2 flex">
        <a href="{{ route('dashboard') }}" class="text-lg font-bold text-primary">VISIIIME</a>
    </div>
    <div class="flex-1 items-stretch flex">
        <div class="hidden md:inline-block">
            <a href="{{ route('vPage.setUrl') }}" class="btn btn-link text-neutral">新增頁面</a>
            <a href="{{ route('dashboard.userSetting') }}" class="btn btn-link text-neutral">個人檔案</a>
            <a href="{{ route('dashboard.userSubscriptionRecord') }}" class="btn btn-link text-neutral">訂閱紀錄</a>
        </div>
    </div>

    <div class="flex-none">
        <div class="hidden md:inline-block">
            <div class="dropdown dropdown-end">
                <div tabindex="0" class="m-1 border-none bg-none">

                    <div class="avatar">
                        <div class="rounded-full w-10 h-10 m-1">
                            <img src="https://i.pravatar.cc/500?img=1">
                        </div>
                    </div>
                </div>
                <ul tabindex="0" class="shadow menu dropdown-content bg-base-100 rounded-box w-52 text-gray-800">
                    <li>
                        <a class="text-sm flex-wrap">
                            <span class="text-sm inline-block">{{ Auth::user()->name }}</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="cursor-pointer"
                            style="padding: .75rem 1.25rem;">
                            @csrf
                            <a :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                登出
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="inline-block md:hidden">
            
            <div class="dropdown dropdown-end">
                <button class="btn btn-square">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="inline-block w-6 h-6 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                </button>
                <ul tabindex="0" class="shadow menu dropdown-content bg-base-100 rounded-box w-52 text-gray-800">
                    <li>
                        <a href="{{ route('vPage.setUrl') }}" class="font-bold">新增頁面</a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.userSetting') }}" class="font-bold">個人檔案</a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard.userSubscriptionRecord') }}" class="font-bold">訂閱紀錄</a>
                    </li>
                    <li>
                        <a class="text-sm flex-wrap">
                            <span class="text-sm inline-block">{{ Auth::user()->name }}</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="cursor-pointer"
                            style="padding: .75rem 1.25rem;">
                            @csrf
                            <a :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                登出
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
