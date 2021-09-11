@extends('components.web.layouts.main')


@section('style')
<style>

</style>
@endsection

@section('content')
<div class="antialiased bg-body text-body font-body">

    <form method="POST" action="{{ route('password.update') }}" class="py-12">
        @csrf

        <div class="container px-4 mx-auto">
            <div class="rounded-xl border flex flex-col max-w-md mx-auto text-center px-8">
                <div class="my-12 mb-8 md:mb-12">
                    <span class="text-sm text-blueGray-400"></span>
                    <h4 class="mb-6 text-3xl">重設密碼</h4>
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <!-- <div class="flex mb-4 px-4 bg-gray-50 rounded">

                        <input value="{{ old('email', $request->email) }}" name="email"  type="email" class="w-full py-4 text-xs placeholder-gray-400 font-semibold leading-none bg-gray-50 outline-none" placeholder="name@email.com" required="" autofocus="">
                        <svg class="h-6 w-6 ml-4 my-auto text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                            </path>
                        </svg>
                    </div> -->
                   

                    <!-- Password -->
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
                  
                    
                    <div class="flex mb-6 px-4 bg-gray-50 rounded">
                        <input
                            name="password_confirmation"
                            class="w-full py-4 text-xs placeholder-gray-400 font-semibold leading-none bg-gray-50 outline-none"
                            type="password" placeholder="Confirm Password"
                            required
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
                    <button class="block w-full p-4 text-center text-md text-white font-semibold leading-none bg-indigo-600 hover:bg-indigo-700 rounded">重設密碼</button>


                  
                    <div>
                        @include('components.web.layouts.errors')
                    </div>
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