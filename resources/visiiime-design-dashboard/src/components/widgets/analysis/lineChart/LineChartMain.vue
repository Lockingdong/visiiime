<template>
    <div>
        <LineChart :chartdata="lineChartData" :options="lineChartOptions" :height="200" />
    </div>
</template>
<script>
import LineChart from "./LineChart";
import trackApi from "@/api/track/TrackApi";
export default {
    components: {
        LineChart,
        PieChart
    },
    data() {
        return {
            lineChartData: {
                labels: ['1', '2', '3', '4', '5'],
                datasets: [
                    {
                        label: '總點擊',
                        fill: false,
                        backgroundColor: "#8eb9dd",
                        data: [1, 2, 3, 4, 5],
                        borderColor: "#8eb9dd",
                    },
                    {
                        label: '獨立點擊',
                        fill: false,
                        backgroundColor: "#13b881",
                        data: [1, 2, 3, 4, 100],
                        borderColor: "#13b881",
                    }
                ]
            },
            lineChartOptions: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: '次數'
                    },
                    ticks: {
                        suggestedMax: 5,
                        stepSize: 1,
                        min: 0
                        }
                    }]
                }
            },
            pieChartData: {
                datasets: [{
                    data: [10, 20, 30],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                }],
                labels: [
                    'Red',
                    'Yellow',
                    'Blue'
                ]
            },
            pieChartOptions: {}
        }
    },
    methods: {
        async groupBy(keys) {
            return (array) => {
                return array.reduce((objectsByKeyValue, obj) => {
                    let value = keys.map((key) => {
                        return obj[key];
                    }).join('-');
                    objectsByKeyValue[value] = (objectsByKeyValue[value] || []).concat(obj);
                    return objectsByKeyValue;
                }, {});
            };
        },
        async groupByCount(data) {
            return Object
                .entries(data)
                .map(([, value]) => ({
                    country: value[0].country,
                    count: value.length
                }))
        }
    },
    async mounted() {

        try {

            let { data } = await trackApi.getEventData();

            let groupBy = await this.groupBy(['country']);

            let groupByData = await groupBy(data);

            let groupByDataCount = await this.groupByCount(groupByData)

            console.log(groupByDataCount)

        } catch (err) {

            console.log(err)

        }
    }
  
}
</script>
