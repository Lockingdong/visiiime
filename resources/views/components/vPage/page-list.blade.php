<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css" integrity="sha512-y6ZMKFUQrn+UUEVoqYe8ApScqbjuhjqzTuwUMEGMDuhS2niI8KA3vhH2LenreqJXQS+iIXVTRL2iaNfJbDNA1Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body class="py-20 bg-gray-50"> 
    <section>
        <div class="container px-10 mx-auto">
            <table class="bg-white rounded shadow mx-auto w-full max-w-2xl">
                <thead>
                    <tr class="text-left text-xs">
                        <th class="px-4 py-4 font-normal w-auto">＃</th>
                        <th class="px-4 py-4 font-normal w-2/3">網域</th>
                        <th class="px-4 py-4 font-normal w-auto">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pageList as $page)
                    <tr class="border-t border-blueGray-100">
                        <td class="px-4 py-2 text-xs font-semibold">
                            <span class="flex w-8 h-8 items-center justify-center text-xs rounded-full bg-blue-50 text-blue-600">1</span>

                        </td>

                        <td class="flex px-6 py-4 text-xs">
                            <img class="w-8 h-8 -ml-2 border border-white rounded-full object-top object-cover" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=128&amp;q=60">
                            <div class="pl-4">
                                <p class="font-semibold">Irene</p>
                                <a class="text-blueGray-400" href="#">
                                    www.reactjs.org
                                    <span class="text-blue-600">/ Irene</span>
                                </a>
                            </div>
                        </td>

                        <td class="py-2 px-2 sm:py-3 sm:px-6 text-xs">
                            <a class="w-full md:w-auto py-2 px-2 sm:py-3 sm:px-6 text-xs text-white font-semibold leading-none bg-blue-600 hover:bg-blue-700 rounded" href="{{ route('vPage.pageDesign', ['page_id' => $page->id]) }}">編輯</a>
                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- <div>
        <ul>
            @foreach ($pageList as $page)
            <li>
                {{ $page->page_url }} <a href="{{ route('vPage.pageDesign', ['page_id' => $page->id]) }}">edit</a>
            </li>
            @endforeach
        </ul>
    </div> -->
</body>

</html>