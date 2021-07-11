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
        <ul>
            @foreach ($pageList as $page)
            <li>
                {{ $page->page_url }} <a href="{{ route('vPage.pageDesign', ['page_id' => $page->id]) }}">edit</a>
            </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
