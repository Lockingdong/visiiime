<template>
    <div class="mb-10 text-center">
        <div class="text-xl mb-3 text-center">{{ title }}</div>
        <PieChart 
            v-if="loaded" 
            :chartdata="pieChartData" 
            :options="pieChartOptions" 
            style="width:250px;margin: 0 auto;"
        />
    </div>
</template>
<script>
import PieChart from "./PieChart";
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
        },
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
            pieChartData: {
                datasets: [{
                    data: [],
                    backgroundColor: [
                        '#570ef8',
                        '#737373',
                        '#737373',
                        '#737373',
                        '#737373',
                        '#737373',
                        '#737373',
                        '#737373',
                        '#737373',
                        '#737373',
                        '#737373',
                        '#737373',
                    ],
                }],
                labels: []
            },
            pieChartOptions: {
                responsive: true,
                maintainAspectRatio: true,
                
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
        },
        async sortList(list) {
            let sorted = list.slice().sort((firstEl, secondEl) => {
                if(firstEl.count < secondEl.count) return 1;
                if(firstEl.count > secondEl.count) return -1;
                return 0;
            });
            return sorted;
        },
    },
    async mounted() {
        try {

            let groupBy = await this.groupBy([this.dataName]);

            let groupByData = await groupBy(this.anaData);

            let groupByDataCount = await this.groupByCount(groupByData)

            let sortedData = await this.sortList(groupByDataCount);

            await this.insertData(sortedData)

            this.loaded = true

        } catch (err) {

            console.log(err)
        }

    }
  
}
</script>
