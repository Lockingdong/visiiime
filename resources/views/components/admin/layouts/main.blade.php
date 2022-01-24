<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

        @yield('style')
        {{-- <link href="/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> --}}
        <link href="/admin/css/sb-admin-2.min.css" rel="stylesheet">
        <style>
            #btn-json-viewer {
                top: 10px;
                left: 20px;
                background-color: #0578ba;
                color: #fff;
                padding: 5px 10px;
                margin-right: 20px;
                border-radius: 4px;
                margin-bottom: 20px;
            }

            /* Syntax highlighting for JSON objects */
            ul.json-dict, ol.json-array {
                list-style-type: none;
                margin: 0 0 0 1px;
                border-left: 1px dotted #ccc;
                padding-left: 2em;
            }
            .json-string {
                color: #0B7500;
            }
            .json-literal {
                color: #1A01CC;
                font-weight: bold;
            }

            /* Toggle button */
            a.json-toggle {
                position: relative;
                color: inherit;
                text-decoration: none;
            }
            a.json-toggle:focus {
                outline: none;
            }
            a.json-toggle:before {
                color: #aaa;
                content: "\25BC"; /* down arrow */
                position: absolute;
                display: inline-block;
                width: 1em;
                left: -1em;
            }
            a.json-toggle.collapsed:before {
                content: "\25B6"; /* left arrow */
            }

            /* Collapsable placeholder links */
            a.json-placeholder {
                color: #aaa;
                padding: 0 1em;
                text-decoration: none;
            }
            a.json-placeholder:hover {
                text-decoration: underline;
            }

            pre.modal  {
                word-break: break-all;
                word-wrap: break-word;
                padding: 52px;
            }
        </style>

    </head>
    <body id="page-top">


        <div id="wrapper">
            {{-- sidebar --}}
            @include('components.admin.layouts.sidebar')

            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">

                    {{-- navbar --}}
                    @include('components.admin.layouts.navbar')

                    <div class="container-fluid">
                        @include('components.admin.layouts.messages')
                        @include('components.admin.layouts.error')
                        @yield('content')
                    </div>

                </div>
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
            </div>

        </div>



        <script src="/admin/vendor/jquery/jquery.min.js"></script>
        <script src="/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="/admin/js/sb-admin-2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.1/vue.js" integrity="sha512-P28EOrljM7l5/DKqt9dMpmDcmoQsLd6gEpgBMQcbsMg2IqtuSM7YqrfRdWwKJEHYhlEq7KjujU1p0SrT7heRUw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @yield('script')
    </body>
</html>
