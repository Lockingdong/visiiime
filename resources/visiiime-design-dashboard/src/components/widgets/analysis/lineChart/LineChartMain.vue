<template>
    <div>
        <LineChart v-if="loaded" :chartdata="lineChartData" :options="lineChartOptions" :height="200" />
    </div>
</template>
<script>
import LineChart from "./LineChart";
import moment from "moment"
export default {
    components: {
        LineChart,
    },
    props: {
        startAt: {
            type: String,
            required: true
        },
        endAt: {
            type: String,
            required: true
        },
        anaData: {
            default: [],
            required: true
        }
    },
    data() {
        return {
            lineChartData: {
                labels: [],
                datasets: [
                    {
                        label: '總觀看次數',
                        fill: false,
                        backgroundColor: "#8eb9dd",
                        data: [],
                        borderColor: "#8eb9dd",
                    },
                    {
                        label: '獨立觀看次數',
                        fill: false,
                        backgroundColor: "#13b881",
                        data: [],
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
        async emptyDataset() {
            let startDate = moment(this.startAt, 'YYYY-MM-DD');
            let dataset = {};
    
            while (startDate.isSameOrBefore(this.endAt)) {
                dataset[startDate.format('YYYY-MM-DD')] = [];
                startDate.add(1, 'days');
            }
            return dataset;
        },
        async transformDate(data) {
            return data.map(el => {
                el.createdDate = moment(el.created_at).format('YYYY-MM-DD');
                return el;
            });
        },
        async mergeEmptyDataset(data) {
            
            let emptyDataset = await this.emptyDataset();

            Object.keys(emptyDataset).forEach(date => {

                emptyDataset[date] = data[date] || []
                
            });

            return emptyDataset;
        },
        async setData(data) {
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
        }
    },
    async mounted() {

        try {

            let groupBy = await this.groupBy(['createdDate']);

            let transformedData = await this.transformDate(this.anaData);

            let groupByData = await groupBy(transformedData);

            let dataset = await this.mergeEmptyDataset(groupByData);

            await this.setData(dataset)

            this.loaded = true

        } catch (err) {

            console.log(err)
        }

    }
  
}
</script>
