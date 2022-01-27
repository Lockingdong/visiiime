@if (count($errors) > 0)
<div class="container mx-auto pt-2 px-4 max-w-xl">
    <div class="container mx-auto max-w-xl">
        <div class="max-w-xl mx-auto bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded text-sm">
            <p class="font-bold">有錯誤發生：</p>
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
</div>
@endif

