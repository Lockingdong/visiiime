@extends('components.web.layouts.main')


@section('style')
    <style>

    </style>
@endsection

@section('content')
<div class="antialiased bg-body text-body font-body">

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
