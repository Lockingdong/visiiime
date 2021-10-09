@if (count($errors) > 0)
<div class="container mx-auto pt-5 px-4 max-w-xl">
    <div class="flash-message mt-2">
        <div class="alert-error p-4 rounded-lg">
            <p class="font-bold">有錯誤發生：</p>
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
    </div>
</div>
@endif

