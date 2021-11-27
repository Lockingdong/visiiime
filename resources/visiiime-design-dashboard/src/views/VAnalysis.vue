<template>
    <div class="bg-gray-100 pb-14">
        <div class="container mx-auto pt-10 px-4 max-w-3xl" :key="componentKey">
            <!-- <h6 class="my-4 text-4xl font-bold card-title">基本資料</h6> -->
            <div class="mb-3 p-3">
                <div class="text-center">
                    <select v-model="period" class="select select-bordered w-full max-w-xs">
                        <option value="7">近7日</option> 
                        <option value="15">近15日</option> 
                        <option value="30">近30日</option>
                    </select>
                </div>
            </div>
            <div class="card shadow-md mb-4 p-3 bg-white relative" >
                <LineChart :ana-data="anaData" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
            </div>
            <div class="about card shadow-md mb-3 p-3 bg-white">
            
                <PieChart :ana-data="anaData" :title="'國家'" :data-name="'country'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
                <PieChart :ana-data="anaData" :title="'系統'" :data-name="'system'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
                <PieChart :ana-data="anaData" :title="'瀏覽器'" :data-name="'browser'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
                <PieChart :ana-data="anaData" :title="'語系'" :data-name="'lang'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
                <PieChart :ana-data="anaData" :title="'裝置'" :data-name="'device'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
                <PieChart :ana-data="anaData" :title="'導流網址'" :data-name="'refer'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
            </div>
        </div>
    </div>
</template>

<script>
// import LineChart from "@/components/widgets/analysis/LineChart";
import PieChart from "@/components/widgets/analysis/pieChart/PieChartMain";
import LineChart from "@/components/widgets/analysis/lineChart/LineChartMain";
import moment from "moment";
import trackApi from "@/api/track/TrackApi";
import { linkEvent } from "@/enum/vo/LinkItemEnum";

import { isProd } from '@/helper/env'

export default {
    data() {
        return {
            period: 7,
            componentKey: 0,
            anaData: []
            // startAt: '2021-11-20',
            // endAt: '2021-11-25'
        }
    },
    components: {
        PieChart,
        LineChart
    },
    computed: {
        startAt() {
            let startAt = moment().subtract(this.period - 1, "days").format("YYYY-MM-DD");
            return startAt;  
        },
        endAt() {
            let now = moment().format('YYYY-MM-DD');
            return now;
        }
    },
    methods: {
        async getData() {
            let { data } = await trackApi.getEventData({
                model_id: this.$store.state.pageId,
                start_at: this.startAt,
                end_at: this.endAt,
                event_type: linkEvent.pageView,
                is_parent: true
            });

            return data;
        },
        async updateComponent() {
            this.componentKey += 1;
        }
    },
    watch: {
        async period() {

            this.anaData = await this.getData();

            await this.updateComponent();
        }
    },
    async mounted() {

        this.anaData = await this.getData();

        await this.updateComponent();

    }
    
};
</script>
