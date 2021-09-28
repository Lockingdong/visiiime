<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visiiime | {{ $title }}</title>
    <link rel="stylesheet" href="/dashboard/css/tailwind/tailwind.min.css" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    @include('components.web.layouts.colors')
    @yield('style')
</head>

<body class="pt-16">

    @include('components.web.layouts.navbar')
    
    @yield('content')

    @include('components.web.layouts.footer')

    <script src="/dashboard/js/main.js"></script>
    @yield('scripts')
</body>

</html>
