<template>
    <div class="about">
        <!-- <h1>This is an about page</h1> -->
        <!-- <LineChart :chartdata="lineChartData" :options="lineChartOptions" :height="200" /> -->
        <PieChart :title="'國家'" :data-name="'country'" :height="200" />
        <PieChart :title="'系統'" :data-name="'system'" :height="200" />
        <PieChart :title="'瀏覽器'" :data-name="'browser'" :height="200" />
        <PieChart :title="'語系'" :data-name="'lang'" :height="200" />
        <PieChart :title="'裝置'" :data-name="'device'" :height="200" />
        <PieChart :title="'導流網址'" :data-name="'refer'" :height="200" />


    </div>
</template>

<script>
// import LineChart from "@/components/widgets/analysis/LineChart";
import PieChart from "@/components/widgets/analysis/pieChart/PieChartMain";
// import trackApi from "@/api/track/TrackApi";

export default {
    components: {
        PieChart
    },
    
};
</script>
