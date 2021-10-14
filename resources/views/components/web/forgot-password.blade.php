@extends('components.web.layouts.main')


@section('style')
    <style>

    </style>
@endsection

@section('content')
<section class="relative py-20">
    @include('components.web.layouts.errors')
    @include('components.web.layouts.messages')
    <div class="container px-4 mx-auto">
        <div class="max-w-md mx-auto py-6 lg:py-12 px-4 lg:px-8 bg-white border rounded-xl text-center">
            <span class="inline-block mb-4 text-xs text-blue-400 font-semibold">Forgot Password</span>
            <h3 class="mb-12 text-3xl font-semibold font-heading">忘記密碼</h3>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="relative flex flex-wrap mb-6">
                    <input class="relative mb-2 md:mb-0 w-full py-4 pl-4 text-sm border rounded" type="email"
                        value="{{ old('email') }}"
                        name="email"
                        placeholder="visiiime@visiiime.com" required autofocus>
                    <span class="absolute top-0 left-0 ml-4 -mt-2 px-1 inline-block bg-white text-gray-500 text-xs">Email</span>
                </div>
                <button
                    type="submit"
                    class="w-full inline-block py-4 mb-4 text-sm text-white font-medium leading-normal bg-v-purple-300 hover:bg-v-purple-200 rounded transition duration-200">
                    發送重設密碼連結至信箱</button>    
            </form>
        </div>
    </div>
</section>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
