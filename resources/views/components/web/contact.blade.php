@extends('components.web.layouts.main')


@section('style')
    <style>

    </style>
@endsection

@section('content')
    <section class="py-20">
        <div class="container px-4 mx-auto">
            <div class="max-w-2xl mx-auto mb-12 lg:mb-20 text-center">
                <span class="text-xs text-blue-400 font-semibold">What's new at Shuffle</span>
                <h2 class="mt-8 mb-10 text-3xl lg:text-4xl font-semibold font-heading">Lorem ipsum dolor sit amet consectutar
                    domor at elis</h2>
                <p class="text-xl text-gray-500">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa
                    nibh, pulvinar vitae aliquet nec, accumsan aliquet orci.</p>
            </div>
            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-1/3 px-4 mb-4 lg:mb-0">
                    <div class="py-12 h-full border text-center rounded-xl">
                        <h3 class="mb-6 text-2xl font-semibold font-heading">Address</h3>
                        <p class="text-gray-500">1686 Geraldine Lane</p>
                        <p class="text-gray-500">New York, NY 10013</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 px-4 mb-4 lg:mb-0">
                    <div class="py-12 h-full border text-center rounded-xl">
                        <h3 class="mb-6 text-2xl font-semibold font-heading">Contact</h3>
                        <p class="text-gray-500">hello@wireframes.org</p>
                        <p class="text-gray-500">+7-843-672-431</p>
                    </div>
                </div>
                <div class="w-full lg:w-1/3 px-4 lg:mb-0">
                    <div class="py-12 h-full border text-center rounded-xl">
                        <h3 class="mb-7 text-2xl font-semibold font-heading">Socials</h3>
                        <div class="flex flex-wrap items-end justify-center">
                            <a class="inline-flex items-center justify-center w-10 h-10 mr-4 rounded-full bg-gray-50"
                                href="#">
                                <svg width="7" height="12" viewBox="0 0 7 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.08986 11.8182V6.51068H5.90543L6.17782 4.44164H4.08986V3.12086C4.08986 2.52201 4.2587 2.1139 5.13522 2.1139L6.25131 2.11345V0.26283C6.0583 0.238228 5.39575 0.181824 4.62462 0.181824C3.01437 0.181824 1.91196 1.14588 1.91196 2.91594V4.44164H0.0908813V6.51068H1.91196V11.8182H4.08986Z"
                                        fill="#758A99"></path>
                                </svg>
                            </a>
                            <a class="inline-flex items-center justify-center w-10 h-10 mr-4 rounded-full bg-gray-50"
                                href="#">
                                <svg width="13" height="11" viewBox="0 0 13 11" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.5454 2.09731C12.0904 2.29895 11.6021 2.43569 11.0891 2.49674C11.6129 2.18307 12.0139 1.68553 12.2039 1.0945C11.7126 1.38499 11.1702 1.59592 10.5923 1.71026C10.1296 1.21658 9.47132 0.909088 8.74122 0.909088C7.34053 0.909088 6.20483 2.04479 6.20483 3.4447C6.20483 3.64325 6.22724 3.83717 6.27051 4.0226C4.16291 3.91675 2.29405 2.90699 1.04324 1.37262C0.824591 1.74656 0.700208 2.18228 0.700208 2.64739C0.700208 3.52737 1.14831 4.30382 1.82819 4.75808C1.41253 4.74418 1.0216 4.62984 0.679359 4.43978V4.47145C0.679359 5.69986 1.55392 6.72507 2.71356 6.9584C2.5011 7.01557 2.27706 7.04725 2.04528 7.04725C1.8815 7.04725 1.72312 7.03103 1.56782 7.00012C1.89075 8.00834 2.82714 8.74151 3.93657 8.76161C3.06895 9.44149 1.97498 9.84555 0.786753 9.84555C0.582026 9.84555 0.380369 9.83319 0.181824 9.81079C1.30439 10.5316 2.6371 10.9519 4.06946 10.9519C8.73508 10.9519 11.2854 7.08743 11.2854 3.73598L11.2769 3.40763C11.7752 3.05222 12.2063 2.60567 12.5454 2.09731Z"
                                        fill="#758A99"></path>
                                </svg>
                            </a>
                            <a class="inline-flex items-center justify-center w-10 h-10 mr-4 rounded-full bg-gray-50"
                                href="#">
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M4.06713 0.454544H9.9328C11.9249 0.454544 13.5456 2.07521 13.5455 4.06716V9.93284C13.5455 11.9248 11.9249 13.5455 9.9328 13.5455H4.06713C2.07518 13.5455 0.45459 11.9249 0.45459 9.93284V4.06716C0.45459 2.07521 2.07518 0.454544 4.06713 0.454544ZM9.9329 12.384C11.2845 12.384 12.3841 11.2844 12.3841 9.93283H12.384V4.06716C12.384 2.71565 11.2844 1.61603 9.93282 1.61603H4.06715C2.71564 1.61603 1.61609 2.71565 1.61609 4.06716V9.93283C1.61609 11.2844 2.71564 12.384 4.06715 12.384H9.9329ZM3.57148 7.00007C3.57148 5.10948 5.10951 3.57142 7.00005 3.57142C8.8906 3.57142 10.4286 5.10948 10.4286 7.00007C10.4286 8.89058 8.8906 10.4286 7.00005 10.4286C5.10951 10.4286 3.57148 8.89058 3.57148 7.00007ZM4.75203 6.99999C4.75203 8.23952 5.76054 9.2479 7.00004 9.2479C8.23955 9.2479 9.24806 8.23952 9.24806 6.99999C9.24806 5.76038 8.23963 4.75192 7.00004 4.75192C5.76046 4.75192 4.75203 5.76038 4.75203 6.99999Z"
                                        fill="#758A99"></path>
                                </svg>
                            </a>
                            <a class="inline-flex items-center justify-center w-10 h-10 mr-4 rounded-full bg-gray-50"
                                href="#">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.8 0H1.2C0.54 0 0 0.54 0 1.2V10.8C0 11.46 0.54 12 1.2 12H10.8C11.46 12 12 11.46 12 10.8V1.2C12 0.54 11.46 0 10.8 0ZM3.6 10.2H1.8V4.8H3.6V10.2ZM2.7 3.78C2.1 3.78 1.62 3.3 1.62 2.7C1.62 2.1 2.1 1.62 2.7 1.62C3.3 1.62 3.78 2.1 3.78 2.7C3.78 3.3 3.3 3.78 2.7 3.78ZM10.2 10.2H8.4V7.02C8.4 6.54002 7.98 6.12 7.5 6.12C7.02 6.12 6.6 6.54002 6.6 7.02V10.2H4.8V4.8H6.6V5.52C6.9 5.04 7.56 4.68 8.1 4.68C9.24 4.68 10.2 5.64 10.2 6.78V10.2Z"
                                        fill="#758A99"></path>
                                </svg>
                            </a>
                            <a class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-gray-50" href="#">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8 2C4.685 2 2 4.75474 2 8.15226C2 10.871 3.719 13.1765 6.1025 13.9894C6.4025 14.0473 6.5125 13.8569 6.5125 13.6936C6.5125 13.5475 6.5075 13.1604 6.505 12.6475C4.836 13.0184 4.484 11.8221 4.484 11.8221C4.211 11.112 3.8165 10.9221 3.8165 10.9221C3.273 10.5407 3.8585 10.5486 3.8585 10.5486C4.461 10.5913 4.7775 11.1825 4.7775 11.1825C5.3125 12.1232 6.182 11.8513 6.525 11.6943C6.579 11.2962 6.7335 11.0254 6.905 10.8715C5.5725 10.7176 4.172 10.1886 4.172 7.83139C4.172 7.15992 4.4045 6.61106 4.7895 6.18063C4.722 6.02516 4.5195 5.3996 4.842 4.55231C4.842 4.55231 5.3445 4.38744 6.492 5.18308C6.972 5.04639 7.482 4.97856 7.992 4.97543C8.502 4.97856 9.012 5.04639 9.492 5.18308C10.632 4.38744 11.1345 4.55231 11.1345 4.55231C11.457 5.3996 11.2545 6.02516 11.1945 6.18063C11.577 6.61106 11.8095 7.15992 11.8095 7.83139C11.8095 10.1948 10.407 10.715 9.072 10.8663C9.282 11.051 9.477 11.4282 9.477 12.0047C9.477 12.828 9.4695 13.4896 9.4695 13.6894C9.4695 13.8506 9.5745 14.0431 9.882 13.9816C12.2825 13.1739 14 10.8668 14 8.15226C14 4.75474 11.3135 2 8 2Z"
                                        fill="#758A99"></path>
                                </svg>
                            </a>
                        </div>
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
