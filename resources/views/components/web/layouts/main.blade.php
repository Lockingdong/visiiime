<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if (env('APP_ENV') !== 'production')
    <meta name="robots" content="noindex">
    @endif
    <title>Visiiime | {{ $title }}</title>
    <link rel="icon" type="image/x-icon" href="/images/web/favicon.ico">
    <link rel="stylesheet" href="/dashboard/css/tailwind/tailwind.min.css" crossorigin="anonymous"
        referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Primary Meta Tags -->
    <meta name="title" content="Visiiime | {{ $title }}">
    <meta name="description" content="Share your Bio with Visiiime.">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Visiiime | {{ $title }}">
    <meta property="og:description" content="Share your Bio with Visiiime.">
    <meta property="og:image" content="{{ url('/') . '/images/web/og-image.png' }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="Visiiime | {{ $title }}">
    <meta property="twitter:description" content="Share your Bio with Visiiime.">
    <meta property="twitter:image" content="{{ url('/') . '/images/web/og-image.png' }}">
    @include('components.web.layouts.colors')
    @yield('style')
</head>

<body class="pt-16">

    @include('components.web.layouts.navbar')

    @yield('content')

    @include('components.web.layouts.footer')

    <script src="/dashboard/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @yield('scripts')
</body>

</html>
