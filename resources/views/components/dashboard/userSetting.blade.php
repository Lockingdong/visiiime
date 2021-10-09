@extends('components.dashboard.layouts.main')

@section('content')
    
    <div class="container mx-auto pt-10 px-4 max-w-xl pb-8">
        {{-- <div class="text-2xl mb-3">目前方案</div> --}}
        {{-- @if ($isVvip)
        <div class="card shadow-md mb-4 bg-white relative">
            <div class="px-5">
                <h2 class="my-4 text-4xl font-bold card-title">Visiiime Premium</h2>
                <div class="mb-4 space-x-2 card-actions">
                    <div class="badge badge-info">下次扣款時間: {{ $latestRecord->us_next_auth_at }}</div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                
            </div>
        </div>
        @else
        <div class="card shadow-md mb-4 bg-white relative">
            <div class="px-5">
                <h2 class="my-4 text-4xl font-bold card-title">Visiiime Free</h2>
                <div class="mb-4 space-x-2 card-actions">
                    <div class="badge badge-info">使用期限: 永久</div>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                
                <div class="justify-end space-x-2 card-actions mb-4">
                    <button class="btn bg-gray-500">修改信用卡</button> 
                    <a href="{{ route('pricing') }}" class="btn btn-primary">升級為Premium</a> 
                </div>
            </div>
        </div>
        @endif --}}
        
        <h2 class="my-4 text-4xl font-bold card-title">基本資料</h2>
        <div class="card shadow-md mb-4 p-3 bg-white relative">
            <div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">用戶名</span>
                    </label>
                    <input value="{{ auth()->user()->name }}" type="text" placeholder="用戶名"
                        class="input input-bordered w-full">
                    <div>
                        <span class="badge badge-error mt-1 mr-1" style="display: none;"></span>
                    </div>
                </div>
            </div>
            <div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input value="{{ auth()->user()->email }}" disabled type="text" placeholder="Email"
                        class="input input-bordered w-full">
                    <div>
                        <span class="badge badge-error mt-1 mr-1" style="display: none;"></span>
                    </div>
                </div>
            </div>
            <div class="justify-end card-actions">
                <button disabled="disabled" class="btn btn-primary">儲存變更</button>
            </div>
        </div>
        <h2 class="my-4 text-4xl font-bold card-title">修改密碼</h2>
        <div class="card shadow-md mb-4 p-3 bg-white relative">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
    
                <!-- Email Address -->
                <div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">寄發至</span>
                        </label>
                        <input value="{{ auth()->user()->email }}" disabled type="email" placeholder="Email"
                            class="input input-bordered w-full">
                        <input value="{{ auth()->user()->email }}" name="email" type="hidden">
                        <div>
                            <span class="badge badge-error mt-1 mr-1" style="display: none;"></span>
                        </div>
                    </div>
                </div>
    
                <div class="flex items-center justify-end mt-4">
                    @if ($disableEmailButton)
                    <button disabled class="btn btn-primary">已發送，請60秒後再試</button>
                    @else
                    <button class="btn btn-primary">寄發重設密碼連結</button>
                    @endif
                    
                </div>
            </form>
        </div>
    </div>
@endsection
