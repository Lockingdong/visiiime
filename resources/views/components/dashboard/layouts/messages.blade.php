@php
    $msgs = [
        'error' => 'bg-red-100 border-red-500 text-red-700',
        'warning' => 'bg-yellow-100 border-yellow-500 text-yellow-700',
        'success' => 'bg-green-100 border-green-500 text-green-700',
        'info' => 'bg-blue-100border-blue-500 text-blue-700'
    ];
@endphp
@foreach ($msgs as $key => $msg)
    @if(session()->has($key))
    <div class="container mx-auto pt-2 px-4 max-w-xl">
        <div class="container mx-auto max-w-xl">
            <div class="max-w-xl mx-auto border-l-4 {{ $msg }} p-4 rounded text-sm">
                {{ session()->get($key) }}
            </div>
        </div>
    </div>
    @endif
@endforeach