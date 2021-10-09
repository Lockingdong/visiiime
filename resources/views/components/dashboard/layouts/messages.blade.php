@foreach (['error', 'warning', 'success', 'info'] as $msg)
    @if(session()->has($msg))
    <div class="container mx-auto pt-5 px-4 max-w-xl">
        <div class="flash-message mb-2 mt-2 {{$class ?? ''}}">
            <p class="alert alert-{{ $msg }}">
                {{ session()->get($msg) }}
            </p>
        </div>
    </div>
    @endif
@endforeach