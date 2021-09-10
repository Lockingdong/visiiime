@extends('components.web.layouts.main')


@section('style')
<style>

</style>
@endsection

@section('content')
<div class="antialiased bg-body text-body font-body">
     <!-- Session Status -->
     @if (session()->has('status'))
        <div>{{ session('status') }}</div>
        @endif
    <form class="py-12" action="{{ route('password.email') }}">
        @csrf
        <div class="container px-4 mx-auto">
            <div class="rounded-xl border flex flex-col max-w-md mx-auto text-center px-8">
                <div class="my-12 mb-8 md:mb-12">
                    <span class="text-sm text-blueGray-400"></span>
                    <h4 class="mb-6 text-3xl">忘記密碼</h4>

                    <div class="flex mb-4 px-4 bg-gray-50 rounded">

                        <input value="{{ old('email') }}" name="email" class="w-full py-4 text-xs placeholder-gray-400 font-semibold leading-none bg-gray-50 outline-none" type="email" placeholder="name@email.com" required="" autofocus="">
                        <svg class="h-6 w-6 ml-4 my-auto text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                            </path>
                        </svg>
                    </div>
                    <button class="block w-full p-4 text-center text-md text-white font-semibold leading-none bg-indigo-600 hover:bg-indigo-700 rounded">登入</button>
                    <div>
                        @include('components.web.layouts.errors')
                    </div>
                </div>
                <div class="mb-5">
                    <p class="text-xs text-blueGray-400 text-center"><a class="underline hover:text-blueGray-500" href="#"></a></p>
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