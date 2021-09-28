@extends('components.web.layouts.main')


@section('style')
    <style>

    </style>
@endsection

@section('content')
    <section class="relative py-20">
        <img class="hidden lg:block absolute top-0 left-0 mt-64" src="zeus-assets/icons/dots/blue-dot-left-bars.svg" alt="">
        <img class="hidden lg:block absolute top-0 right-0 mt-40" src="zeus-assets/icons/dots/yellow-dot-right-shield.svg"
            alt="">
        <div class="container px-4 mx-auto">
            <div class="max-w-2xl mx-auto mb-20 text-center">
                <span class="text-xs text-blue-400 font-semibold">What's new at Shuffle</span>
                <h2 class="mt-8 mb-10 text-4xl font-semibold font-heading">Lorem ipsum dolor sit amet consectutar domor at
                    elis</h2>
                <p class="mb-16 text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque
                    massa nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
                <div class="max-w-max mx-auto p-1 bg-gray-50 rounded">
                    <button class="px-10 py-4 bg-white rounded text-sm font-semibold leading-normal">Monthly</button>
                    <button
                        class="px-10 py-4 text-sm font-semibold text-gray-500 hover:text-gray-900 leading-normal">Yearly</button>
                </div>
            </div>
            <div class="flex flex-wrap items-center -mx-3">
                <div class="w-full lg:w-1/3 px-3 mb-6 lg:mb-0">
                    <div class="pt-12 pb-8 px-8 border rounded-xl lg:text-center">
                        <h3 class="mb-6 font-medium text-gray-500">Starter</h3>
                        <div class="flex lg:justify-center mb-8">
                            <span class="self-start inline-block mr-1 text-xl font-semibold text-gray-500">$</span>
                            <p class="self-end text-5xl font-semibold font-heading">34,99</p>
                        </div>
                        <ul class="mb-6 text-left">
                            <li class="flex items-center py-4 border-b">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium">Complete documentation</p>
                            </li>
                            <li class="flex items-center py-4 border-b">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium">Working materials in Figma</p>
                            </li>
                            <li class="flex items-center py-4 border-b">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium">100GB cloud storage</p>
                            </li>
                            <li class="flex items-center py-4 mb-8">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium">500 team members</p>
                            </li>
                        </ul>
                        <a class="block py-4 text-sm text-center text-white font-medium leading-normal bg-v-purple-300 hover:bg-v-purple-200 rounded transition duration-200"
                            href="#">Try it now</a>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 px-3 mb-6 lg:mb-0">
                    <div class="pt-12 pb-8 px-8 bg-v-purple-300 rounded-xl lg:text-center">
                        <h3 class="mb-6 font-medium text-white">Pro</h3>
                        <div class="flex lg:justify-center mb-8">
                            <span class="self-start inline-block mr-1 text-xl font-semibold text-white">$</span>
                            <p class="self-end text-5xl font-semibold text-white">65,99</p>
                        </div>
                        <ul class="mb-6 text-left">
                            <li class="flex items-center py-4 border-b border-white">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium text-white">Complete documentation</p>
                            </li>
                            <li class="flex items-center py-4 border-b border-white">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium text-white">Working materials in Figma</p>
                            </li>
                            <li class="flex items-center py-4 border-b border-white">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium text-white">100GB cloud storage</p>
                            </li>
                            <li class="flex items-center py-4 border-b border-white">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium text-white">500 team members</p>
                            </li>
                            <li class="flex items-center py-4 mb-8">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium text-white">Premium support</p>
                            </li>
                        </ul>
                        <a class="inline-block py-4 w-full text-sm text-center font-medium leading-normal text-white rounded bg-blue-400 hover:bg-blue-500 transition duration-200"
                            href="#">Try it now</a>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 px-3 mb-6 lg:mb-0">
                    <div class="pt-12 pb-8 px-8 border rounded-xl lg:text-center">
                        <h3 class="mb-6 font-medium text-gray-500">Premium</h3>
                        <div class="flex lg:justify-center mb-8">
                            <span class="self-start inline-block mr-1 text-xl font-semibold text-gray-500">$</span>
                            <p class="self-end text-5xl font-semibold font-heading">99,99</p>
                        </div>
                        <ul class="mb-6 text-left -mx-8">
                            <li class="flex items-center py-4 pl-8 border-b">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium">Complete documentation</p>
                            </li>
                            <li class="flex items-center py-4 pl-8 border-b">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium">Working materials in Figma</p>
                            </li>
                            <li class="flex items-center py-4 pl-8 border-b">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium">100GB cloud storage</p>
                            </li>
                            <li class="flex items-center py-4 mb-8 pl-8">
                                <svg class="mr-2" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M5.67 0H14.34C17.73 0 20 2.38 20 5.92V14.091C20 17.62 17.73 20 14.34 20H5.67C2.28 20 0 17.62 0 14.091V5.92C0 2.38 2.28 0 5.67 0ZM9.43 12.99L14.18 8.24C14.52 7.9 14.52 7.35 14.18 7C13.84 6.66 13.28 6.66 12.94 7L8.81 11.13L7.06 9.38C6.72 9.04 6.16 9.04 5.82 9.38C5.48 9.72 5.48 10.27 5.82 10.62L8.2 12.99C8.37 13.16 8.59 13.24 8.81 13.24C9.04 13.24 9.26 13.16 9.43 12.99Z"
                                        fill="#45C1FF"></path>
                                </svg>
                                <p class="font-medium">500 team members</p>
                            </li>
                        </ul>
                        <a class="inline-block py-4 w-full text-sm text-center font-medium leading-normal text-white rounded bg-v-purple-300 hover:bg-v-purple-200 transition duration-200"
                            href="#">Try it now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script>

    </script>
@endsection
