<template>
    <div class="mb-3">
        <div class="text-center bg-gray-500 text-white py-1">連結分析</div>
        <div class="p-5">
            <LineChart v-if="loaded" :chartdata="lineChartData" :options="options" :height="300" />
        </div>
    </div>
</template>
<script>
import LineChart from './chart/LineChart.vue'
import trackApi from "@/api/track/TrackApi";
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";

export default {
    components: {
        LineChart,
    },
    data() {
        return {
            datacollection: null,
            loaded: false,
            lineChartData: {
                labels: [],
                datasets: [
                    {
                        label: '總點擊',
                        backgroundColor: "transparent",
                        data: [],
                        borderColor: "#8eb9dd",
                    },
                    {
                        label: '獨立點擊',
                        backgroundColor: "transparent",
                        data: [],
                        borderColor: "#13b881",
                    }
                ]
            },
            options: {
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
                        stepSize: 1,
                        min: 0
                        }
                    }]
                }
            }
        };
    },
    props: {
        idx: {
            type: Number,
            required: true,
        },
        linkItem: {
            type: LinkItemVO,
            required: true,
        },
    },
    methods: {

    },
    mounted() {

        trackApi.getWeekData({
            model_id: this.linkItem.id
        }).then( rs => {

            this.loaded = true;
            let data = rs.data;
            Object.keys(data).forEach(date => {
                let dateArr = date.split('-');
                this.lineChartData.labels.push(`${dateArr[1]}/${dateArr[2]}`)

                let all = [];
                let single = [];

                data[date].forEach(item => {
                    // 總點擊
                    all.push(item.ip);

                    // 獨立點擊
                    if(!single.includes(item.ip)) {
                        single.push(item.ip)
                    }

                })

                // 總點擊
                this.lineChartData.datasets[0].data.push(all.length)
                // 獨立點擊
                this.lineChartData.datasets[1].data.push(single.length)

            })

        }).catch((err) => {

            console.log(err)
        });

    },
};
</script>

<style lang="scss">
.small {
    max-width: 600px;
    margin:  150px auto;
}
</style>
