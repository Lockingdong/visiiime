<section class="py-12 lg:py-20 bg-gray-50">
    <div class="container mx-auto px-4 mb-12 md:mb-20">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full lg:w-1/3 px-4 mb-6 lg:mb-0">
                <a class="inline-block mb-5 text-gray-900 text-lg font-semibold" href="#">
                    <img class="h-7" src="/dashboard/visiiime-assets/logo/logo-purple.png" alt="" width="auto">
                </a>
                <p class="mb-6 max-w-sm text-base text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing
                    elit.</p>
                <div class="flex">
                    <a class="flex justify-center items-center w-10 h-10 mr-4 bg-v-purple-200 rounded-full" href="https://www.facebook.com/visiiime" target="_blank">
                        <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.0898 11.8182V6.51068H5.90537L6.17776 4.44164H4.0898V3.12086C4.0898 2.52201 4.25864 2.1139 5.13515 2.1139L6.25125 2.11345V0.26283C6.05824 0.238228 5.39569 0.181824 4.62456 0.181824C3.01431 0.181824 1.9119 1.14588 1.9119 2.91594V4.44164H0.0908203V6.51068H1.9119V11.8182H4.0898Z"
                                fill="#ffffff"></path>
                        </svg>
                    </a>
                    <a class="flex justify-center items-center w-10 h-10 mr-4 bg-v-purple-200 rounded-full" href="https://www.instagram.com/visiiime" target="_blank">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M4.06713 0.454529H9.9328C11.9249 0.454529 13.5456 2.07519 13.5455 4.06715V9.93282C13.5455 11.9248 11.9249 13.5454 9.9328 13.5454H4.06713C2.07518 13.5454 0.45459 11.9249 0.45459 9.93282V4.06715C0.45459 2.07519 2.07518 0.454529 4.06713 0.454529ZM9.9329 12.3839C11.2845 12.3839 12.3841 11.2844 12.3841 9.93282H12.384V4.06714C12.384 2.71563 11.2844 1.61601 9.93282 1.61601H4.06715C2.71564 1.61601 1.61609 2.71563 1.61609 4.06714V9.93282C1.61609 11.2844 2.71564 12.384 4.06715 12.3839H9.9329ZM3.57148 7.00005C3.57148 5.10947 5.10951 3.5714 7.00005 3.5714C8.8906 3.5714 10.4286 5.10947 10.4286 7.00005C10.4286 8.89056 8.8906 10.4285 7.00005 10.4285C5.10951 10.4285 3.57148 8.89056 3.57148 7.00005ZM4.75203 6.99998C4.75203 8.23951 5.76054 9.24788 7.00004 9.24788C8.23955 9.24788 9.24806 8.23951 9.24806 6.99998C9.24806 5.76036 8.23963 4.75191 7.00004 4.75191C5.76046 4.75191 4.75203 5.76036 4.75203 6.99998Z"
                                fill="#ffffff"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="w-full lg:w-2/3 px-4">
                <div class="flex flex-wrap justify-end -mx-4">
                    <div class="w-1/2 lg:w-1/4 px-4 mb-8 lg:mb-0">
                        <h3 class="mb-6 text-base font-medium">Company</h3>
                        <ul class="text-sm">
                            <li class="mb-4"><a class="text-gray-500 hover:text-gray-600" href="{{ route('about') }}">About
                                    Us</a></li>
                            {{-- <li class="mb-4"><a class="text-gray-500 hover:text-gray-600"
                                    href="{{ route() }}">Careers</a></li> --}}
                            <li><a class="text-gray-500 hover:text-gray-600" href="{{ route('blogList') }}">Blog</a></li>
                        </ul>
                    </div>
                    <div class="w-1/2 lg:w-1/4 px-4 mb-8 lg:mb-0">
                        <h3 class="mb-6 text-base font-medium">Pages</h3>
                        <ul class="text-sm">
                            <li class="mb-4"><a class="text-gray-500 hover:text-gray-600" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="mb-4"><a class="text-gray-500 hover:text-gray-600"
                                    href="{{ route('register') }}">Register</a></li>
                            <li class="mb-4"><a class="text-gray-500 hover:text-gray-600" href="{{ route('pricing') }}">Pricing</a></li>
                            <li><a class="text-gray-500 hover:text-gray-600" href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                    <div class="w-1/2 lg:w-1/4 px-4 mb-8 lg:mb-0">
                        <h3 class="mb-6 text-base font-medium">Legal</h3>
                        <ul class="text-sm">
                            <li class="mb-4"><a class="text-gray-500 hover:text-gray-600" href="{{ route('terms') }}">Terms</a>
                            </li>
                            <li><a class="text-gray-500 hover:text-gray-600" href="{{ route('privacy') }}">Privacy</a></li>
                        </ul>
                    </div>
                    {{-- <div class="w-1/2 lg:w-1/4 px-4">
                        <h3 class="mb-6 text-base font-medium">Resources</h3>
                        <ul class="text-sm">
                            <li class="mb-4"><a class="text-gray-500 hover:text-gray-600" href="#">Blog</a>
                            </li>
                            <li class="mb-4"><a class="text-gray-500 hover:text-gray-600"
                                    href="#">Service</a></li>
                            <li class="mb-4"><a class="text-gray-500 hover:text-gray-600"
                                    href="#">Product</a></li>
                            <li><a class="text-gray-500 hover:text-gray-600" href="#">Pricing</a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    <p class="text-center text-sm text-gray-500 pt-8 px-4 border-t">All rights reserved © Visiiime 2021</p>
</section>