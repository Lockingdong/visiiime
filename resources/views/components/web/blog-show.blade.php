@extends('components.web.layouts.main')


@section('style')
    <style>

    </style>
@endsection

@section('content')
    <section class="py-20">
        <div class="container px-4 mx-auto">
            <div class="max-w-2xl mx-auto">
                <span class="inline-block mb-3 text-xs px-2 py-1 bg-blue-50 rounded uppercase text-blue-400 font-semibold">{{ $VBlogPost->VBlogCategory->cate_name }}</span>
                <h2 class="mb-10 text-3xl font-semibold font-heading"
                    style="text-overflow: ellipsis; word-break: break-all;">
                    {{ $VBlogPost->post_title }}</h2>
                <div class="h-112 mb-10">
                    <img class="w-full h-full object-cover rounded-lg"
                         src="{{ url($VBlogPost->post_banner) }}"
                         alt="">
                </div>
                {!! $VBlogPost->post_content !!}
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>

    </script>
@endsection
