<template>
    <div>
        <div class="text-xl mb-3">{{ title }}</div>
        <PieChart v-if="loaded" :chartdata="pieChartData" :options="pieChartOptions" :height="200" />
    </div>
</template>
<script>
import PieChart from "./PieChart";
import trackApi from "@/api/track/TrackApi";
import { isProd } from '@/helper/env'
export default {
    components: {
        PieChart
    },
    props: {
        dataName: {
            type: String,
            required: true
        },
        title: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            pieChartData: {
                datasets: [{
                    data: [],
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                }],
                labels: []
            },
            pieChartOptions: {},
            loaded: false
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
                    [this.dataName]: value[0][this.dataName],
                    count: value.length
                }))
        },
        async insertData(data) {
            data.forEach(el => {
                this.pieChartData.datasets[0].data.push(el.count)

                if(this.dataName === 'refer') {
                    this.pieChartData.labels.push((el[this.dataName] === '') ? '無導流' : el[this.dataName])
                } else {
                    this.pieChartData.labels.push(el[this.dataName])
                }
            });
        }
    },
    async mounted() {

        try {

            let { data } = await trackApi.getEventData({
                model_id: isProd() ? window.pid : this.$store.state.pageId,
                start_at: "2021-11-20",
                end_at: "2021-11-20",
                is_parent: true
            });

            let groupBy = await this.groupBy([this.dataName]);

            let groupByData = await groupBy(data);

            let groupByDataCount = await this.groupByCount(groupByData)

            await this.insertData(groupByDataCount)

            this.loaded = true

        } catch (err) {

            console.log(err)
        }

    }
  
}
</script>
