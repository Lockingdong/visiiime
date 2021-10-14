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
            <span class="inline-block mb-4 text-xs text-blue-400 font-semibold">Reset Password</span>
            <h3 class="mb-12 text-3xl font-semibold font-heading">重設密碼</h3>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="relative flex flex-wrap mb-6">
                    <input value="{{ $request->email }}" class="relative mb-2 md:mb-0 w-full py-4 pl-4 text-sm rounded" type="email"
                        disabled
                        >
                    <span
                        class="absolute top-0 left-0 ml-4 -mt-2 px-1 inline-block bg-white text-gray-500 text-xs">Email
                        </span>
                </div>
                <input type="hidden" name="email" value="{{ $request->email }}" required />

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
                
                <button
                    class="w-full inline-block py-4 mb-4 text-sm text-white font-medium leading-normal bg-v-purple-300 hover:bg-v-purple-200 rounded transition duration-200">
                    重設密碼</button>
                
            </form>
            
        </div>
    </div>
</section>

{{-- <div class="antialiased bg-body text-body font-body">

    <div class="w-1/2">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <label for="email">Email</label>

                <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password">Password</label>

                <input id="password" class="block mt-1 w-full" type="password" name="password" required />
            </div>

            <div class="mt-4">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button>
                    Reset Password
                </button>
            </div>
        </form>
    </div>

</div> --}}
@endsection

@section('scripts')
    <script>

    </script>
@endsection
