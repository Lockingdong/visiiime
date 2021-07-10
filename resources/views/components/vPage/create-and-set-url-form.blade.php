<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{ $confirmUrl }}">
        @csrf
        <label for="url">set your url</label>
        <input id="url" name="page_url" type="text" value={{ old('page_url') }}>
        <button>confirm</button>
    </form>

    @if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
        <div> {{ $error }} </div>
        @endforeach
    </div>
    @endif
</body>
</html>
