@if (session()->has('success'))
    <div class="mb-2 max-w-md mx-auto">
        <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
            <p class="text-sm">{{ session('success') }}</p>
        </div>
    </div>
@endif
