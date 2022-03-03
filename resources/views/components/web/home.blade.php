@extends('components.web.layouts.main')


@section('style')
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.5.9/slick-theme.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.slick/1.5.9/slick.css">


    <style>
        .demo {
            position: relative;
        }

        .demo:before {
            content: '';
            display: block;
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            opacity: 0.15;
            /* background-image: url('https://image.freepik.com/free-vector/graphical-memphis-element-retro-geometric-elements-memphis-style-funky-modern-print-symbols-collection-vintage-monochrome-geometrical-shapes-contemporary-bauhaus-objects_229548-180.jpg'); */
            background-repeat: no-repeat;
            background-position: 50% 0;
            background-size: cover;
            z-index: -1;
        }

    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100;200;300;400;500;600;700&display=swap"
    rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="/index-banner/css/style.css">
@endsection

@section('content')
    <div class="banner">
        <div class="banner-img" id="scene" style="z-index: -1;">
            <div class="b-background" data-depth="0.1">
                <div class="box">
                    <img class="img2" src="/index-banner/images/t.png" alt="twitter">
                    <img class="img6" src="/index-banner/images/in.png" alt="in">
                    <img class="img7" src="/index-banner/images/i.png" alt="ins">
                    <img class="img10" src="/index-banner/images/s.png" alt="s">
                </div>
            </div>
            <div class="b-background" data-depth="0.3">
                <div class="box">
                    <img class="img3" src="/index-banner/images/i.png" alt="ins">
                    <img class="img8" src="/index-banner/images/f.png" alt="facebook">
                    <img class="img9" src="/index-banner/images/t.png" alt="twitter">

                </div>
            </div>
            <div class="b-background" data-depth="0.6">
                <div class="box">
                    <img class="img1" src="/index-banner/images/i.png" alt="ins">
                    <img class="img4" src="/index-banner/images/s.png" alt="s">
                    <img class="img5" src="/index-banner/images/t.png" alt="twitter">
                    <img class="img11" src="/index-banner/images/in.png" alt="ins">
                    <img class="img12" src="/index-banner/images/00.png" alt="">
                </div>
            </div>
        </div>
        <div class="content">
            <h1>
                Share your Bio with Visiiime
            </h1>
            <h2>
                透過一個連結，輕鬆整合您的社群媒體
            </h2>
            <div class="kv">
                <div class="kvimg">
                    <img src="/index-banner/images/phone.png" alt="">
                    <div class="kvimg-cont">
                        <div class="idpic animate__animated animate__bounceIn">
                            <img src="/index-banner/images/girl.png" alt="">
                        </div>
                        <h3 class="animate__animated animate__bounceInDown">
                            Visiiime
                        </h3>
                        <div class="text"></div>

                        <div class="link">
                            <div class="cont cont1 animate__animated animate__bounceIn">
                                <img src="/index-banner/images/0001.png" alt="">
                                <h4>
                                    Link
                                </h4>
                            </div>
                            <div class="cont cont2 animate__animated animate__bounceIn">
                                <img src="/index-banner/images/0002.png" alt="">
                                <h4>
                                    Link
                                </h4>
                            </div>
                            <div class="cont cont3 animate__animated animate__bounceIn">
                                <img src="/index-banner/images/0003.png" alt="">
                                <h4>
                                    Link
                                </h4>
                            </div>
                        </div>
                        <div class="link-btn">
                            <div class="cont cont1 animate__animated animate__fadeInRight">
                                <div class="icon">
                                    <img src="/index-banner/images/cb-facebook.748fce0a.png" alt="">
                                </div>
                                <p>
                                    Facebook
                                </p>
                            </div>
                            <div class="cont cont2 animate__animated animate__fadeInRight">
                                <div class="icon">
                                    <img src="/index-banner/images/cb-instagram.581b9a2d.png" alt="">
                                </div>
                                <p>
                                    Instagram
                                </p>
                            </div>
                        </div>
                        <div class="link-icons">
                            <img class="icon1 animate__animated animate__bounceIn" src="/index-banner/images/icon_Messenger.svg" alt="">
                            <img class="icon2 animate__animated animate__bounceIn" src="/index-banner/images/icon_Pinterest.svg" alt="">
                            <img class="icon3 animate__animated animate__bounceIn" src="/index-banner/images/icon_shapi.svg" alt="">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="py-10 lg:py-16 z-10 bg-white">
        <div class="container px-4 mx-auto">

            @foreach ($section2['data'] as $k => $item)
                <div class="flex flex-wrap items-center -mx-4 {{ count($section2['data']) === $k + 1 ? '' : 'mb-8' }}">
                    <div class="w-full lg:w-1/2 px-4">
                        <div class="text-center">
                            <h2 class="mb-4 text-2xl lg:text-3xl font-semibold font-heading">{{ $item['title'] }}</h2>
                            <p class="text-lg lg:text-xl text-gray-500">{{ $item['content'] }}</p>
                        </div>
                    </div>
                    <div
                        class="{{ $k % 2 ? 'order-first lg:order-first' : 'order-first lg:order-last' }} w-full lg:w-1/2 px-4 mb-8 lg:mb-0 order">
                        <div class="flex items-center justify-center">
                            <img class="w-1/2 lg:w-2/3 rounded-lg max-w-sm" src="/images/web/{{ $item['image'] }}.png"
                                alt="">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="py-10 lg:py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10">
                <h2 class="mb-4 text-2xl lg:text-3xl font-semibold font-heading">更多功能</h2>
            </div>
            <div class="flex flex-wrap -mx-3 -mb-6">

                @foreach ($section3['data'] as $k => $item)
                    <div class="w-full md:w-1/3 lg:w-1/3 px-3 mb-6">
                        <div class="text-center px-1">
                            <span class="flex items-center justify-center mx-auto mb-8 md:mb-8 w-45 h-45 rounded-full">
                                <img class="w-1/2 lg:w-2/3 rounded-lg max-w-sm" src="/images/web/{{ $item['image'] }}.png"
                                    alt="">
                            </span>
                            <div>
                                <h3 class="mb-2 lg:mb-4 text-xl font-semibold font-heading">{{ $item['title'] }}</h3>
                                <p class="text-base text-gray-500">{{ $item['content'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <section class="pt-20 pb-10 demo bg-white">
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap items-center -mx-4 mb-8">
                <div class="w-full lg:w-1/2 px-4">
                    <div class="text-center mb-6">
                        {{-- <span class="inline-block mb-3 text-xs px-2 py-1 bg-blue-50 rounded uppercase text-blue-400 font-semibold">Development</span> --}}
                        <h2 class="mb-4 text-3xl font-semibold font-heading">立即體驗Visiiime</h2>
                        {{-- <span class="inline-block mb-6 text-xs text-gray-500">10 jun 2020 19:40</span> --}}
                        <p class="text-xl text-gray-500">立即註冊為Visiiime，並輕鬆打造您獨一無二的專屬頁面吧！</p>
                    </div>
                    <div class="text-center">
                        <a class="inline-block px-8 py-4 text-sm text-white font-semibold bg-v-purple-300 hover:bg-v-purple-200 rounded transition duration-200"
                            href="{{ route('register') }}">立即註冊</a>
                    </div>
                </div>
                <div class="order-first lg:order-last w-full lg:w-1/2 px-4 mb-8 lg:mb-0">
                    <div class="flex items-center justify-center">
                        <div style="width:350px;height:600px;border-width:12px;border-radius:40px;"
                            class="border-gray-700 relative overflow-hidden">
                            <iframe style="border-radius:28px;"
                                class="w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                                src="{{ route('personalPage', 'visiiime') }}" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    {{-- <section class="py-20">
    <div class="container px-4 mx-auto">
        <div class="max-w-3xl mx-auto mb-16 text-center">
            <span class="text-xs text-blue-400 font-semibold">What's new at Shuffle</span>
            <h2 class="mt-8 mb-10 text-4xl font-semibold font-heading">Lorem ipsum dolor sit amet consectutar domor at
                elis</h2>
            <div class="max-w-2xl mx-auto">
                <p class="text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                    massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
            </div>
        </div>
        <div class="flex flex-wrap -m-4 my-slider">
            <a href="#" class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl ">
                    <img class="w-full h-full rounded-lg object-fit mx-auto" src="https://picsum.photos/400/300" alt="">
                </div>
                <p class="text-xl text-gray-500 text-center">Kevin</p>
            </a>
            <a href="#" class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl">
                    <img class="w-full h-full rounded-lg object-fit mx-auto" src="https://picsum.photos/400/300" alt="">
                </div>
                <p class="text-xl text-gray-500 text-center">Kevin</p>
            </a>
            <a href="#" class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl">
                    <img class="w-full h-full rounded-lg object-fit mx-auto" src="https://picsum.photos/400/300" alt="">
                </div>
                <p class="text-xl text-gray-500 text-center">Kevin</p>
            </a>
            <a href="#" class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl">
                    <img class="w-full h-full rounded-lg object-fit mx-auto" src="https://picsum.photos/400/300" alt="">
                </div>
                <p class="text-xl text-gray-500 text-center">Kevin</p>
            </a>
            <a href="#" class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl">
                    <img class="w-full h-full rounded-lg object-fit mx-auto" src="https://picsum.photos/400/300" alt="">
                </div>
                <p class="text-xl text-gray-500 text-center">Kevin</p>
            </a>
            <a href="#" class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl">
                    <img class="w-full h-full rounded-lg object-fit mx-auto" src="https://picsum.photos/400/300" alt="">
                </div>
                <p class="text-xl text-gray-500 text-center">Kevin</p>
            </a>
        </div>
    </div>
</section> --}}
    {{-- <section class="py-20">
    <div class="container px-4 mx-auto">
        <div class="max-w-3xl mx-auto mb-16 text-center">
            <span class="text-xs text-blue-400 font-semibold">What's new at Shuffle</span>
            <h2 class="mt-8 mb-10 text-4xl font-semibold font-heading">Lorem ipsum dolor sit amet consectutar domor at
                elis</h2>
            <div class="max-w-2xl mx-auto">
                <p class="text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                    massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
            </div>
        </div>
        <div class="flex flex-wrap -m-4">
            <div class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl py-12">
                    <img class="h-6 mx-auto" src="/dashboard/visiiime-assets/logo/slack-gray.svg" alt="">
                </div>
            </div>
            <div class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl py-12">
                    <img class="h-6 mx-auto" src="/dashboard/visiiime-assets/logo/dropbox-gray.svg" alt="">
                </div>
            </div>
            <div class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl py-12">
                    <img class="h-6 mx-auto" src="/dashboard/visiiime-assets/logo/spotify-gray.svg" alt="">
                </div>
            </div>
            <div class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl py-12">
                    <img class="h-6 mx-auto" src="/dashboard/visiiime-assets/logo/amazon-gray.svg" alt="">
                </div>
            </div>
            <div class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl py-12">
                    <img class="h-6 mx-auto" src="/dashboard/visiiime-assets/logo/netflix-gray.svg" alt="">
                </div>
            </div>
            <div class="w-full md:w-1/3 lg:w-1/6 p-4">
                <div class="bg-gray-50 rounded-xl py-12">
                    <img class="h-6 mx-auto" src="/dashboard/visiiime-assets/logo/stripe-gray.svg" alt="">
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection

@section('scripts')
    <script src="https://www.soeasyedu.com.tw/js/jquery-2.2.4.min.js"></script>
    <script src="/index-banner/js/antigravity.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>
    <script>
    // Pretty simple huh?
    var scene = document.getElementById('scene');
    var parallaxInstance = new Parallax(scene);
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js"></script>

    <script>
        $('.my-slider').slick({

            speed: 5000,
            autoplay: true,
            autoplaySpeed: 0,
            cssEase: 'linear',
            slidesToShow: 5,
            infinite: true,
            swipeToSlide: true,
            centerMode: true,
            focusOnSelect: true,
            arrows: false,
            responsive: [{
                    breakpoint: 991,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 575,
                    settings: {
                        slidesToShow: 2,
                    }
                },
            ]
        });
    </script>
@endsection
