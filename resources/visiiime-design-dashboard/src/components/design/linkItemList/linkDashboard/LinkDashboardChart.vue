<template>
    <div class="mb-3">
        <div class="text-center bg-gray-500 text-white py-1">連結分析</div>
        <div v-if="hasPermission" class="p-5">
            <LineChart v-if="loaded" :chartdata="lineChartData" :options="options" :height="200" />
            <div class="p-5 pt-0 text-center">
                <v-button @click="$modal.show(`linkItemChartModal${linkItem.id}`)">查看更多</v-button>
            </div>
        </div>
        <div v-else class="p-5">
            <!-- todo -->
            You don't have the permission.
        </div>

        <modal
            :name="`linkItemChartModal${linkItem.id}`"
            :max-width="600"
            width="90%"
            height="auto"
            :adaptive="true"
        >
            <v-card>
                <div class="mb-2">
                    <v-tag @click.native="changeChart('country')" class="text-lg py-2 cursor-pointer mr-1" tag-name="h1" variant="badge">國家</v-tag>
                    <v-tag @click.native="changeChart('browser')" class="text-lg py-2 cursor-pointer mr-1" tag-name="h1" variant="badge">瀏覽器</v-tag>
                    <v-tag @click.native="changeChart('system')" class="text-lg py-2 cursor-pointer mr-1" tag-name="h1" variant="badge">系統</v-tag>
                    <v-tag @click.native="changeChart('lang')" class="text-lg py-2 cursor-pointer" tag-name="h1" variant="badge">語系</v-tag>
                </div>
                <div>
                </div>
                <div v-if="currentChart === 'country'">
                    <v-card v-for="(c, idx) in sortedCountries" :key="idx">
                        <div class="flex items-center justify-between">
                            <div>{{ c.iso_code }}</div>
                            <v-tag tag-name="span" variant="badge">{{ c.count }}</v-tag>
                        </div>
                    </v-card>
                </div>
                <div v-if="currentChart === 'browser'">
                    <v-card v-for="(c, idx) in sortedBrowsers" :key="idx">
                        <div class="flex items-center justify-between">
                            <div>{{ c.browser }}</div>
                            <v-tag tag-name="span" variant="badge">{{ c.count }}</v-tag>
                        </div>
                    </v-card>
                </div>
                <div v-if="currentChart === 'system'">
                    <v-card v-for="(c, idx) in sortedSystems" :key="idx">
                        <div class="flex items-center justify-between">
                            <div>{{ c.system }}</div>
                            <v-tag tag-name="span" variant="badge">{{ c.count }}</v-tag>
                        </div>
                    </v-card>
                </div>
                <div v-if="currentChart === 'lang'">
                    <v-card v-for="(c, idx) in sortedLangs" :key="idx">
                        <div class="flex items-center justify-between">
                            <div>{{ c.lang }}</div>
                            <v-tag tag-name="span" variant="badge">{{ c.count }}</v-tag>
                        </div>
                    </v-card>
                </div>
            </v-card>
        </modal>
    </div>
</template>
<script>
import LineChart from './chart/LineChart.vue'
import trackApi from "@/api/track/TrackApi";
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import { CAN_USE_LINK_ITEM_DBOARD_CHART } from "@/enum/permission/vBasic/VPermission";

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
                        fill: false,
                        backgroundColor: "#8eb9dd",
                        data: [],
                        borderColor: "#8eb9dd",
                    },
                    {
                        label: '獨立點擊',
                        fill: false,
                        backgroundColor: "#13b881",
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
                        suggestedMax: 5,
                        stepSize: 1,
                        min: 0
                        }
                    }]
                }
            },
            currentChart: 'country',
            countries: [],
            browsers: [],
            systems: [],
            langs: []
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
    computed: {
        hasPermission() {
            return this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_DBOARD_CHART);
        },
        sortedCountries() {
            return this.sortList('countries');
        },
        sortedBrowsers() {
            return this.sortList('browsers');
        },
        sortedSystems() {
            return this.sortList('systems');
        },
        sortedLangs() {
            return this.sortList('langs');
        }
    },
    methods: {
        setData(item, field, list) {
            let findIdx = this[list].findIndex(el => el[field] === item[field]);
            if(findIdx === -1) {
                this[list].push({
                    [field]: item[field],
                    count: 1,
                });
            } else {
                this[list][findIdx].count ++;
            }
        },
        sortList(list) {
            const sorted = this[list].slice().sort((firstEl, secondEl) => {
                if(firstEl.count < secondEl.count) return 1;
                if(firstEl.count > secondEl.count) return -1;
                return 0;
            });
            return sorted;
        },
        changeChart(type) {
            this.currentChart = type
        }
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

                    // 國家排名
                    this.setData(item, 'iso_code', 'countries');

                    this.setData(item, 'browser', 'browsers');

                    this.setData(item, 'system', 'systems');

                    this.setData(item, 'lang', 'langs');

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
