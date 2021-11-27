@if ($errors->any())
    <div class="mb-2 max-w-md mx-auto">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            @foreach ($errors->all() as $error)
            <p class="text-sm">* {{ $error }}</p>
            @endforeach
        </div>
    </div>
@endif
