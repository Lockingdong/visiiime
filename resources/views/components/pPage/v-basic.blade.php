<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>個人頁</title>
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