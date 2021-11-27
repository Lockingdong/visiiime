@extends('components.web.layouts.main')


@section('style')
    <style>

    </style>
@endsection

@section('content')
    <section class="relative py-20">
        <img class="hidden lg:block absolute top-0 left-0 mt-20"
             src="/dashboard/visiiime-assets/icons/dots/blue-dot-left-bars.svg" alt="">
        <img class="hidden lg:block absolute top-0 right-0 mt-52"
             src="/dashboard/visiiime-assets/icons/dots/yellow-dot-right-shield.svg"
             alt="">
        <div class="container px-4 mx-auto">
            <div class="max-w-2xl mx-auto mb-20 text-center">
                <span class="text-xs text-blue-400 font-semibold">What's new at Shuffle</span>
                <h2 class="mt-8 mb-10 text-4xl font-semibold font-heading">Lorem ipsum dolor sit amet consectutar domor
                    at
                    elis</h2>
                <p class="text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                    massa
                    nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
            </div>
            <div class="flex flex-wrap -mx-4 -mb-16">
                @foreach($VPosts as $key => $VPost)
                    <div class="w-full {{ $key === 0 ? 'lg:w-2/3' : 'lg:w-1/3' }} px-4 mb-16">
                        @if ($VPost->post_banner !== null)
                        <div class="flex h-96 mb-10">
                            <img class="w-full h-full object-cover rounded-xl"
                                 src="{{ url($VPost->post_banner) }}"
                                 alt="">
                        </div>
                        @endif
                        <span class="inline-block mb-4 text-xs text-gray-500">{{ date('jS M Y', strtotime($VPost->created_at)) }}</span>
                        @if ($VPost->VCategory !== null)
                        <span class="inline-block mb-3 text-xs px-2 py-1 bg-blue-50 rounded uppercase text-blue-400 font-semibold">{{ $VPost->VCategory->cate_name }}</span>
                        @endif
                        <h2 class="mb-4 text-3xl font-semibold font-heading"
                            style="text-overflow: ellipsis; word-break: break-all; overflow: hidden"
                        >
                        {{ $VPost->post_index_title }}
                    </h2>
                        <p class="mb-4 text-xl text-gray-500"
                           style="text-overflow: ellipsis; word-break: break-all; overflow: hidden"
                        >
                            {{ $VPost->post_index_content }}
                        </p>
                        <a class="text-lg font-medium text-v-purple-300 underline hover:no-underline"
                           href="{{ route('blogShow', $VPost->id) }}">Read more</a>
                    </div>
                @endforeach
            </div>
                {{ $VPosts->links() }}
        </div>
    </section>

@endsection

@section('scripts')
    <script>

    </script>
@endsection
