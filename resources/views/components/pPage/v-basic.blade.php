<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>個人頁</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@100;400;500&display=swap" rel="stylesheet">
</head>
<body>
    <div id="app">
    </div>
    <script>
        window.vistorData = @json($vistorData);
        window.pageContent = @json($pageContent);
    </script>
    <script src="{{ mix('js/Theme/VBasic.js') }}"></script>
</body>
</html>
