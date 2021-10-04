@extends('components.web.layouts.main')


@section('style')
    <style>

    </style>
@endsection

@section('content')
    <section class="relative py-20">
        <div class="container px-4 mx-auto">
            <div class="flex flex-wrap items-center -mx-4">
                <div class="relative w-full lg:w-5/12 px-4 order-last lg:order-first">
                    <img class="hidden lg:block mx-auto h-96 lg:h-112 object-cover" src="/dashboard/visiiime-assets/images/z-picture.png"
                        alt="">
                    <img class="hidden lg:block absolute top-0 left-0 mt-32 -ml-16"
                        src="/dashboard/visiiime-assets/icons/dots/blue-dot-left-bars.svg" alt="">
                </div>
                <div class="w-full lg:w-7/12 px-4">
                    <div class="max-w-xl lg:ml-auto">
                        <span class="inline-block mb-10">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M26 29.45C26 19.3858 33.4577 8.86747 45.2297 6.16443C45.6793 6.0612 46.1364 6.29467 46.3301 6.71327L47.5161 9.27572C47.7602 9.80299 47.5031 10.4238 46.9877 10.692C43.3044 12.608 40.1644 17.1966 39.3647 20.8059C39.2493 21.3268 39.6241 21.8042 40.1413 21.9351C44.6581 23.0784 48 27.1681 48 32.042C48 38.406 42.832 42 37.602 42C31.572 42 26 37.39 26 29.45ZM0 29.45C0 19.3858 7.45772 8.86747 19.2297 6.16443C19.6793 6.0612 20.1364 6.29467 20.3301 6.71327L21.5161 9.27572C21.7602 9.80299 21.5031 10.4238 20.9877 10.692C17.3044 12.608 14.1644 17.1966 13.3647 20.8059C13.2493 21.3268 13.6241 21.8042 14.1413 21.9351C18.6581 23.0784 22 27.1681 22 32.042C22 38.406 16.832 42 11.602 42C5.572 42 0 37.39 0 29.45Z"
                                    fill="#FF4564"></path>
                            </svg>
                        </span>
                        <h2 class="mb-10 text-4xl font-semibold font-heading">Lorem ipsum dolor sit amet consectutar domor at
                            elis</h2>
                        <p class="mb-10 text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Pellentesque massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
                        <div class="mb-12 w-full h-px bg-gray-100">
                            <div class="h-full w-1/2 bg-v-purple-300"></div>
                        </div>
                        <div>
                            <img class="mb-6 lg:hidden h-16 object-cover" src="/dashboard/visiiime-assets/images/z-picture.png" alt="">
                            <p class="mb-3 pr-4 text-2xl font-semibold font-heading">Esther Howard</p>
                            <p class="text-gray-500">CEO &amp; Founder</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img class="hidden lg:block absolute bottom-0 right-0" src="/dashboard/visiiime-assets/icons/dots/yellow-dot-right-shield.svg"
            alt="">
    </section>

@endsection

@section('scripts')
    <script>

    </script>
@endsection
