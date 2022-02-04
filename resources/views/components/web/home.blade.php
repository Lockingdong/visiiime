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
@endsection

@section('content')
<section class="relative pt-20 pb-20 lg:pb-32">
    <img class="hidden lg:block absolute top-0 left-0 mt-32" src="/dashboard/visiiime-assets/icons/dots/blue-dot-left-bars.svg" alt="">
    <img class="hidden lg:block absolute top-0 right-0 mt-32" src="/dashboard/visiiime-assets/icons/dots/yellow-dot-right.svg" alt="">
    <div class="relative container px-4 mx-auto">
        <div class="max-w-2xl mx-auto text-center mb-12 lg:mb-20">
            <span class="text-xs font-semibold text-blue-400">Visiiime</span>
            <h2 class="mt-8 mb-10 text-4xl font-semibold font-heading">Share your Bio with Visiiime</h2>
            <p class="mb-10 text-xl text-gray-500">透過一個連結，輕鬆整合您的社群媒體</p>
            {{-- <div class="flex justify-center items-center mb-16">
                <a class="mr-4" href="#">
                    <img src="/dashboard/visiiime-assets/buttons/app-store.svg" alt="">
                </a>
                <a href="#">
                    <img src="/dashboard/visiiime-assets/buttons/google-play.svg" alt="">
                </a>
            </div> --}}
        </div>
        {{-- <div class="flex flex-wrap items-center -mx-4 -mb-8">
            <div class="w-full lg:w-2/6 px-4">
                <div class="flex mb-8">
                    <span class="flex-shrink-0 flex items-center justify-center w-12 h-12 bg-teal-400 mr-4 rounded-full">
                        <svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.98451 19.606C8.98451 19.606 16.6565 17.283 16.6565 10.879C16.6565 4.474 16.9345 3.974 16.3195 3.358C15.7035 2.742 9.99051 0.75 8.98451 0.75C7.97851 0.75 2.26551 2.742 1.65051 3.358C1.03451 3.974 1.31251 4.474 1.31251 10.879C1.31251 17.283 8.98451 19.606 8.98451 19.606Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M6.38593 9.87463L8.27793 11.7696L12.1759 7.86963" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <div>
                        <h3 class="mb-4 text-2xl font-semibold font-heading">Security in saving</h3>
                        <p class="text-lg text-gray-500">Pellentesque eu quam vitae mi lacinia consequat quis in metus.
                        </p>
                    </div>
                </div>
                <div class="flex mb-8">
                    <span class="flex-shrink-0 flex items-center justify-center w-12 h-12 bg-v-purple-300 mr-4 rounded-full">
                        <svg width="22" height="20" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.9026 6.8512L12.4593 10.4642C11.6198 11.1302 10.4387 11.1302 9.59919 10.4642L5.11841 6.8512" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.9089 19C18.9502 19.0084 21 16.5095 21 13.4384V6.57001C21 3.49883 18.9502 1 15.9089 1H6.09114C3.04979 1 1 3.49883 1 6.57001V13.4384C1 16.5095 3.04979 19.0084 6.09114 19H15.9089Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <div>
                        <h3 class="mb-4 text-2xl font-semibold font-heading">Weekly email updates</h3>
                        <p class="text-lg text-gray-500">Pellentesque eu quam vitae mi lacinia consequat quis in metus.
                        </p>
                    </div>
                </div>
                <div class="flex mb-8">
                    <span class="flex-shrink-0 flex items-center justify-center w-12 h-12 bg-blue-400 mr-4 rounded-full">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0001 0.750122C15.1081 0.750122 19.2501 4.89112 19.2501 10.0001C19.2501 15.1081 15.1081 19.2501 10.0001 19.2501C4.89112 19.2501 0.750122 15.1081 0.750122 10.0001C0.750122 4.89112 4.89112 0.750122 10.0001 0.750122Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9.99524 6.20422V10.6232" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M9.995 13.7961H10.005" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <div>
                        <h3 class="mb-4 text-2xl font-semibold font-heading">No errors</h3>
                        <p class="text-lg text-gray-500">Pellentesque eu quam vitae mi lacinia consequat quis in metus.
                        </p>
                    </div>
                </div>
            </div> --}}
            <div class="w-full px-4 mt-16 mb-16 lg:mt-0 lg:mb-0">
                <div style="width:350px;height:600px;border-width:12px;border-radius:40px;" class="border-gray-700 relative overflow-hidden mx-auto">
                    <iframe style="border-radius:28px;" class="w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" src="{{ route('personalPage', 'visiiime') }}" frameborder="0"></iframe>
                </div>
                {{-- <img class="max-h-96 lg:max-h-128 w-full lg:w-3/4 mx-auto" src="/dashboard/visiiime-assets/images/devices/phone-full.svg" alt=""> --}}
            </div>
            
            {{-- <div class="w-full lg:w-2/6 px-4">
                <div class="flex mb-8">
                    <span class="flex-shrink-0 flex items-center justify-center w-12 h-12 bg-v-purple-300 mr-4 rounded-full">
                        <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.4235 7.4478V5.3008C13.4235 2.7878 11.3855 0.7498 8.87249 0.7498C6.35949 0.7388 4.31349 2.7668 4.30249 5.2808V5.3008V7.4478" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12.6832 19.2496H5.04224C2.94824 19.2496 1.25024 17.5526 1.25024 15.4576V11.1686C1.25024 9.07359 2.94824 7.37659 5.04224 7.37659H12.6832C14.7772 7.37659 16.4752 9.07359 16.4752 11.1686V15.4576C16.4752 17.5526 14.7772 19.2496 12.6832 19.2496Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M8.86292 12.2028V14.4238" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <div>
                        <h3 class="mb-4 text-2xl font-semibold font-heading">Change of access</h3>
                        <p class="text-lg text-gray-500">Pellentesque eu quam vitae mi lacinia consequat quis in metus.
                        </p>
                    </div>
                </div>
                <div class="flex mb-8">
                    <span class="flex-shrink-0 flex items-center justify-center w-12 h-12 bg-yellow-400 mr-4 rounded-full">
                        <svg width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.5 10.8055H1.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M20.6299 6.5951V5.0821C20.6299 3.0211 18.9589 1.3501 16.8969 1.3501H15.6919" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M3.37012 6.5951V5.0821C3.37012 3.0211 5.04112 1.3501 7.10312 1.3501H8.33912" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M20.6299 10.8046V14.8786C20.6299 16.9406 18.9589 18.6116 16.8969 18.6116H15.6919" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M3.37012 10.8046V14.8786C3.37012 16.9406 5.04112 18.6116 7.10312 18.6116H8.33912" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <div>
                        <h3 class="mb-4 text-2xl font-semibold font-heading">Frequent authentication</h3>
                        <p class="text-lg text-gray-500">Pellentesque eu quam vitae mi lacinia consequat quis in metus.
                        </p>
                    </div>
                </div>
                <div class="flex mb-8">
                    <span class="flex-shrink-0 flex items-center justify-center w-12 h-12 bg-gray-900 mr-4 rounded-full">
                        <svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.8877 7.89673C18.2827 7.70073 19.3567 6.50473 19.3597 5.05573C19.3597 3.62773 18.3187 2.44373 16.9537 2.21973" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M18.7285 11.2502C20.0795 11.4522 21.0225 11.9252 21.0225 12.9002C21.0225 13.5712 20.5785 14.0072 19.8605 14.2812" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8867 11.6638C7.67273 11.6638 4.92773 12.1508 4.92773 14.0958C4.92773 16.0398 7.65573 16.5408 10.8867 16.5408C14.1007 16.5408 16.8447 16.0588 16.8447 14.1128C16.8447 12.1668 14.1177 11.6638 10.8867 11.6638Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8867 8.88788C12.9957 8.88788 14.7057 7.17888 14.7057 5.06888C14.7057 2.95988 12.9957 1.24988 10.8867 1.24988C8.77766 1.24988 7.06766 2.95988 7.06766 5.06888C7.05966 7.17088 8.75666 8.88088 10.8587 8.88788H10.8867Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M4.88472 7.89673C3.48872 7.70073 2.41572 6.50473 2.41272 5.05573C2.41272 3.62773 3.45372 2.44373 4.81872 2.21973" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M3.04388 11.2502C1.69288 11.4522 0.749878 11.9252 0.749878 12.9002C0.749878 13.5712 1.19388 14.0072 1.91188 14.2812" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                    <div>
                        <h3 class="mb-4 text-2xl font-semibold font-heading">List of regular users</h3>
                        <p class="text-lg text-gray-500">Pellentesque eu quam vitae mi lacinia consequat quis in metus.
                        </p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>
<section class="py-10 lg:py-16">
    <div class="container px-4 mx-auto">

        @foreach ($section2['data'] as $k => $item)
        <div class="flex flex-wrap items-center -mx-4 {{ count($section2['data']) === ($k+1) ? '' : 'mb-8' }}">
            <div class="w-full lg:w-1/2 px-4">
                <div class="text-center">
                    <h2 class="mb-4 text-2xl lg:text-3xl font-semibold font-heading">{{ $item['title'] }}</h2>
                    <p class="text-lg lg:text-xl text-gray-500">{{ $item['content'] }}</p>
                </div>
            </div>
            <div class="{{ ($k%2) ? 'order-first lg:order-first' : 'order-first lg:order-last' }} w-full lg:w-1/2 px-4 mb-8 lg:mb-0 order">
                <div class="flex items-center justify-center">
                    <img class="w-1/2 lg:w-2/3 rounded-lg max-w-sm" src="/images/web/{{ $item['image'] }}.png" alt="">
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
                        <img class="w-1/2 lg:w-2/3 rounded-lg max-w-sm" src="/images/web/{{ $item['image'] }}.png" alt="">
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
<section class="pt-20 pb-10 demo">
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
                    <a class="inline-block px-8 py-4 text-sm text-white font-semibold bg-v-purple-300 hover:bg-v-purple-200 rounded transition duration-200" href="{{ route('register') }}">立即註冊</a>
                </div>
            </div>
            <div class="order-first lg:order-last w-full lg:w-1/2 px-4 mb-8 lg:mb-0">
                <div class="flex items-center justify-center">
                    <div style="width:350px;height:600px;border-width:12px;border-radius:40px;" class="border-gray-700 relative overflow-hidden">
                        <iframe style="border-radius:28px;" class="w-full h-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2" src="{{ route('personalPage', 'visiiime') }}" frameborder="0"></iframe>
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
        responsive: [
            {
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