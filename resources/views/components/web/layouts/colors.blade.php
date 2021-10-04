@php
    $vPurlple = [
        '500' => '#363082',
        '400' => '#473FA3',
        '300' => '#7864F9',
        '200' => '#9887FF',
        '100' => '#C8AEFF',
    ]
@endphp


<style>
/* purple */

@foreach($vPurlple as $k => $color)

.text-v-purple-@php echo $k @endphp {
    color: @php echo $color @endphp;
}

.bg-v-purple-@php echo $k @endphp {
    background-color: @php echo $color @endphp;
}

.hover\:bg-v-purple-@php echo $k @endphp:hover {
    --tw-bg-opacity: 1;
    background-color: @php echo $color @endphp;
}

.border-v-purple-@php echo $k @endphp {
    --tw-border-opacity: 1;
    border-color: @php echo $color @endphp;
}
@endforeach

</style>

<style>

/* blue */
.text-v-light-blue-300 {
    color: #04FCD9;
}

.text-v-light-blue-200 {
    color: #89FFEE;
}

.text-v-light-blue-100 {
    color: #BFFFF6;
}

.bg-v-light-blue-300 {
    background-color: #04FCD9;
}

.bg-v-light-blue-200 {
    background-color: #89FFEE;
}

.bg-v-light-blue-100 {
    background-color: #BFFFF6;
}

/* pink */
.text-v-pink-500 {
    color: #EC6FF7;
}

.bg-v-pink-500 {
    background-color: #EC6FF7;
}

/* yellow */
.text-v-yellow-500 {
    color: #FFCD1A;
}

.bg-v-yellow-500 {
    background-color: #FFCD1A;
}

/* red */
.text-v-red-500 {
    color: #D52912;
}

.bg-v-red-500 {
    background-color: #D52912;
}

/* orange */
.text-v-orange-500 {
    color: #F38117;
}

.bg-v-orange-500 {
    background-color: #F38117;
}

/* green */
.text-v-green-500 {
    color: #1CBD49;
}

.bg-v-green-500 {
    background-color: #1CBD49;
}

/* blue */
.text-v-blue-500 {
    color: #1B95D9;
}

.bg-v-blue-500 {
    background-color: #1B95D9;
}

</style>
