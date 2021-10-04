@extends('components.web.layouts.main')


@section('style')
    <style>

    </style>
@endsection

@section('content')
    <section class="relative py-20">
        <img class="hidden lg:block absolute top-0 left-0 mt-20" src="/dashboard/visiiime-assets/icons/dots/blue-dot-left-bars.svg" alt="">
        <img class="hidden lg:block absolute top-0 right-0 mt-52" src="/dashboard/visiiime-assets/icons/dots/yellow-dot-right-shield.svg"
            alt="">
        <div class="container px-4 mx-auto">
            <div class="max-w-2xl mx-auto mb-20 text-center">
                <span class="text-xs text-blue-400 font-semibold">What's new at Shuffle</span>
                <h2 class="mt-8 mb-10 text-4xl font-semibold font-heading">Lorem ipsum dolor sit amet consectutar domor at
                    elis</h2>
                <p class="text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa
                    nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
            </div>
            <div class="flex flex-wrap -mx-4 -mb-16">
                <div class="w-full lg:w-2/3 px-4 mb-16">
                    <div class="flex h-96 mb-10">
                        <img class="w-full h-full object-cover rounded-xl"
                            src="https://images.unsplash.com/photo-1525130413817-d45c1d127c42?ixlib=rb-1.2.1&amp;ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80"
                            alt="">
                    </div>
                    <span class="inline-block mb-4 text-xs text-gray-500">10 jun 2020 19:40</span>
                    <h2 class="mb-4 text-3xl font-semibold font-heading">Lorem ipsum dolor sit amet consectutar domor at
                        elis</h2>
                    <p class="mb-4 text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Pellentesque massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
                    <a class="text-lg font-medium text-v-purple-300 underline hover:no-underline" href="{{ route('blogShow') }}">Read more</a>
                </div>
                <div class="w-full lg:w-1/3 px-4 mb-16">
                    <div class="flex h-96 mb-10">
                        <img class="w-full h-full object-cover rounded-xl"
                            src="https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80"
                            alt="">
                    </div>
                    <span class="inline-block mb-4 text-xs text-gray-500">10 jun 2020 19:40</span>
                    <h2 class="mb-4 text-3xl font-semibold font-heading">Lorem ipsum dolor</h2>
                    <p class="mb-4 text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a class="text-lg font-medium text-v-purple-300 underline hover:no-underline" href="{{ route('blogShow') }}">Read more</a>
                </div>
                <div class="w-full lg:w-1/3 px-4 mb-16">
                    <div class="flex h-96 mb-10">
                        <img class="w-full h-full object-cover rounded-xl"
                            src="https://images.unsplash.com/photo-1556761175-4b46a572b786?ixlib=rb-1.2.1&amp;ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;auto=format&amp;fit=crop&amp;w=967&amp;q=80"
                            alt="">
                    </div>
                    <span class="inline-block mb-4 text-xs text-gray-500">10 jun 2020 19:40</span>
                    <h2 class="mb-2 text-3xl font-semibold font-heading">Lorem ipsum dolor</h2>
                    <p class="mb-4 text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a class="text-lg font-medium text-v-purple-300 underline hover:no-underline" href="{{ route('blogShow') }}">Read more</a>
                </div>
                <div class="w-full lg:w-1/3 px-4 mb-16">
                    <div class="flex h-96 mb-10">
                        <img class="w-full h-full object-cover rounded-xl"
                            src="https://images.unsplash.com/photo-1557804506-d8017c1e4856?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1001&amp;q=80"
                            alt="">
                    </div>
                    <span class="inline-block mb-4 text-xs text-gray-500">10 jun 2020 19:40</span>
                    <h2 class="mb-4 text-3xl font-semibold font-heading">Lorem ipsum dolor</h2>
                    <p class="mb-4 text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a class="text-lg font-medium text-v-purple-300 underline hover:no-underline" href="{{ route('blogShow') }}">Read more</a>
                </div>
                <div class="w-full lg:w-1/3 px-4 mb-16">
                    <div class="flex h-96 mb-10">
                        <img class="w-full h-full object-cover rounded-xl"
                            src="https://images.unsplash.com/photo-1544717297-fa95b6ee9643?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1050&amp;q=80"
                            alt="">
                    </div>
                    <span class="text-xs font-semibold text-gray-500">10 jun 2020 19:40</span>
                    <h2 class="mb-4 text-3xl font-semibold font-heading">Lorem ipsum dolor</h2>
                    <p class="mb-4 text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    <a class="text-lg font-medium text-v-purple-300 underline hover:no-underline" href="{{ route('blogShow') }}">Read more</a>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>

    </script>
@endsection
