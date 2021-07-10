<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="{{ $confirmRoute }}" method="POST">
            @csrf
            <div>
                <label for="vbasic">vbasic</label>
                <input id="vbasic" type="radio" name="theme_id" value="VBasic" checked>
            </div>
            <div>
                <label for="marketplace">market place</label>
                <input id="marketplace" type="radio" name="theme_id" disabled>
            </div>
            <button>submit</button>
        </form>
    </div>
</body>
</html>
