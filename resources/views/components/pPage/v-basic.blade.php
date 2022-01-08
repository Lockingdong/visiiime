<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Visiiime | {{ $vPage->getPageTitle() }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;400;500&display=swap" rel="stylesheet">
    <!-- Google+ -->
    <meta itemprop="name" content="{{ $vPage->getPageTitle() }}" />
    <meta itemprop="description" content="{{ $vPage->getPageDesc() }}" />
    <meta itemprop="image" content="{{ $vPage->avatar }}" />

    <!-- Facebook -->
    {{-- <meta property="fb:app_id" content="APP ID" /> --}}
    <meta property="og:type" content="website" /> <!-- 類型 -->
    <meta property="og:title" content="{{ $vPage->getPageTitle() }}" />
    <meta property="og:description" content="{{ $vPage->getPageDesc() }}" />
    <meta property="og:image" content="{{ $vPage->avatar }}" />
    <meta property="og:site_name" content="Visiiime | {{ $vPage->getPageTitle() }}" />
    <meta property="og:url" content="{{ request()->url() }}" />

    

    @if ($vPage->getMeta()->ga_id !== null)
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $vPage->getMeta()->ga_id }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $vPage->getMeta()->ga_id }}');
    </script>
        
    @endif
    
    
    <style>
        * {
            font-family: 'Noto Sans TC', sans-serif;
        }
    </style>
</head>
<body>
    <div id="app">
    </div>
    <script>
        window.pid = '{{ $vPage->id }}'
        window.vd = @json($vd);
        window.pageContent = @json($pageContent);
        window.WINDOW_PROXY_URL = '{{ $WINDOW_PROXY_URL }}'
        window.WINDOW_TRACKER_URL = '{{ $WINDOW_TRACKER_URL }}'
    </script>
    <script src="{{ mix('js/Theme/VBasic.js') }}"></script>
</body>
</html>
