@extends('components.web.layouts.main')


@section('style')
    <style>

    </style>
@endsection

@section('content')
<div class="antialiased bg-body text-body font-body">

    <div class="w-1/2">
        <div class="mb-4 text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>
        <!-- Session Status -->
        @if (session()->has('status'))
            <div>{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email">email</label>

                <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button>
                    Email Password Reset Link
                </button>
            </div>
            <div>
                @include('components.web.layouts.errors')
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
