@extends('components.web.layouts.main')


@section('style')
    <style>
        .changeColor{
            stroke: #838EA4;
        }
    </style>
@endsection

@section('content')
    <section id="VFaq" class="relative py-20">
        <img class="hidden lg:block absolute top-0 left-0 mt-16"
             src="/dashboard/visiiime-assets/icons/dots/blue-dot-left-bars.svg" alt="">
        <img class="hidden lg:block absolute bottom-0 right-0 mb-20"
             src="/dashboard/visiiime-assets/icons/dots/yellow-dot-right-shield.svg"
             alt="">
        <div class="container px-4 mx-auto">
            <div class="max-w-2xl mx-auto text-center mb-12">
                <span class="text-xs text-blue-400 font-semibold">What's new at Shuffle</span>
                <h2 class="mt-8 mb-10 text-4xl font-semibold font-heading">Lorem ipsum dolor sit amet consectutar domor
                    at
                    elis</h2>
                <p class="text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                    massa
                    nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
            </div>
            <div class="max-w-max mb-6 md:mb-14 mx-auto text-center md:border-b">
                @foreach($VCategories as $key => $VCategory)
                        <button
                            @click="location.href = `/help/{{ $VCategory->id }}`"
                            class="text-sm pb-4 mb-2 md:mb-0 mr-4 font-semibold border-b-2
                                {{ $cate_id === $VCategory->id ?
                                    'border-v-purple-300' :
                                    'border-transparent hover:border-gray-500'
                                    }}">
                            {{ $VCategory->cate_name }}
                        </button>
                @endforeach
            </div>

            <div class="max-w-3xl mx-auto">
                <ul>
                    @foreach($VFaqs as $VFaq)
                        <li class="px-6 py-8 border-b"
                            id="{{ $VFaq->faq_title }}"
                        >
                            <button
                                @click="contentToggle('{{ $VFaq->faq_title }}')"
                                class="w-full flex justify-between items-center text-left font-semibold font-heading">
                                <span class="text-2xl font-semibold font-heading">{{ $VFaq->faq_title }}</span>
                                <svg
                                    class="flex-shrink-0"
                                    id="{{ $VFaq->faq_title . 'open' }}"
                                    width="20"
                                    height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    style="display: none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M19.2498 10C19.2498 4.892 15.1088 0.75 9.99976 0.75C4.89176 0.75 0.749756 4.892 0.749756 10C0.749756 15.108 4.89176 19.25 9.99976 19.25C15.1088 19.25 19.2498 15.108 19.2498 10Z"
                                          stroke="#45C1FF" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round">
                                    </path>
                                    <path d="M13.4709 11.4423L9.99995 7.95626L6.52895 11.4423" stroke="#45C1FF"
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <svg
                                    class="flex-shrink-0"
                                    width="20" height="20"
                                    viewBox="0 0 20 20"
                                    fill="none"
                                    id="{{ $VFaq->faq_title . 'close' }}"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M0.750244 10C0.750244 15.108 4.89124 19.25 10.0002 19.25C15.1082 19.25 19.2502 15.108 19.2502 10C19.2502 4.892 15.1082 0.75 10.0002 0.75C4.89124 0.75 0.750244 4.892 0.750244 10Z"
                                          stroke="#838EA4" stroke-width="1.5" stroke-linecap="round"
                                          stroke-linejoin="round">
                                    </path>
                                    <path d="M6.52905 8.55768L10.0001 12.0437L13.4711 8.55768" stroke="#838EA4"
                                          stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <div
                                id="faq_content"
                                style="display: none">
                                <p class="mt-4 text-gray-500 leading-loose">
                                    {!! $VFaq->faq_content !!}
                                </p>
                            </div>
                        </li>
                @endforeach
            </div>
            <div v-show="page==2"></div>
            <div v-show="page==3"></div>
            <div v-show="page==4"></div>
        </div>
    </section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
    <script>
        var VFaq = new Vue({
            el: '#VFaq',
            data: {
            },
            methods: {
                contentToggle(id) {
                    $(`#${id} #faq_content`).slideToggle();
                    $(`#${id}open`).toggle()
                    $(`#${id}close`).toggle()
                },
            }
        })
    </script>
@endsection
