<!DOCTYPE html>
<html lang="zh-TW" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="/dashboard/css/tailwind/tailwind.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.14.1/dist/full.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/vue-js-modal@1.3.31/dist/styles.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/images/web/favicon.ico">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T8EVDDB0TD"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-T8EVDDB0TD');
    </script>
    <style>
        body {
            background: rgba(0, 0, 0, 0.05);
            min-height: 100vh;
        }

        .v--modal {
            border-radius: 1rem !important;
        }
    </style>
</head>
<body>
    @include('components.dashboard.layouts.navbar')
    
    @include('components.dashboard.layouts.messages')
    @include('components.dashboard.layouts.error')
    @yield('content')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.14/vue.min.js" integrity="sha512-XdUZ5nrNkVySQBnnM5vzDqHai823Spoq1W3pJoQwomQja+o4Nw0Ew1ppxo5bhF2vMug6sfibhKWcNJsG8Vj9tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js" integrity="sha512-m2ssMAtdCEYGWXQ8hXVG4Q39uKYtbfaJL5QMTbhl2kc6vYyubrKHhr6aLLXW4ITeXSywQLn1AhsAaqrJl8Acfg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-js-modal@1.3.31/dist/index.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vee-validate/3.2.5/vee-validate.full.min.js"></script>
    <script src="/dashboard/js/main.js"></script>
    <script>
    Vue.component("v-p", VeeValidate.ValidationProvider);
    Vue.component("v-ob", VeeValidate.ValidationObserver);

    VeeValidate.localize({
        en: {
            "messages": {
                "alpha": "{_field_} 須以英文組成",
                "alpha_dash": "{_field_} 須以英數、斜線及底線組成",
                "alpha_num": "{_field_} 須以英數組成",
                "alpha_spaces": "{_field_} 須以英文及空格組成",
                "between": "{_field_} 須介於 {min} 至 {max}之間",
                "confirmed": " {_field_} 不一致",
                "digits": "{_field_} 須為 {length} 位數字",
                "dimensions": "{_field_} 圖片尺寸不正確。須為 {width} x {height} 像素",
                "email": "{_field_} 須為有效的電子信箱",
                "excluded": "{_field_} 的選項無效",
                "ext": "{_field_} 須為有效的檔案",
                "image": "{_field_} 須為圖片",
                "oneOf": "{_field_} 的選項無效",
                "integer": "{_field_} 須為整數",
                "length": "{_field_} 的長度須為 {length}",
                "max": "{_field_} 不能大於 {length} 個字元",
                "max_value": "{_field_} 不得大於 {max}",
                "mimes": "{_field_} 須為有效的檔案類型",
                "min": "{_field_} 不能小於 {length} 個字元",
                "min_value": "{_field_} 不得小於 {min}",
                "numeric": "{_field_} 須為數字",
                "regex": "{_field_} 的格式錯誤",
                "required": "{_field_} 為必填",
                "required_if": "{_field_} 為必填",
                "size": "{_field_} 的檔案須小於 {size}KB",
                "double": "{_field_}字段必須為有效的小數"
            }
        }
    });
    </script>

    @yield('script')
</body>
</html>