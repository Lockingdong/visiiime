<template>
    <div>
        <div class="about card shadow-md mb-3 p-3 bg-white">
            <div class="text-center">
                <select v-model="period" class="select select-bordered w-full max-w-xs">
                    <option value="1">近1日</option> 
                    <option value="7">近7日</option> 
                    <option value="15">近15日</option> 
                    <option value="30">近30日</option>
                </select>
            </div>
        </div>

        <div class="about card shadow-md mb-3 p-3 bg-white" :key="componentKey">
            
            <PieChart :ana-data="anaData" :title="'國家'" :data-name="'country'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
            <PieChart :ana-data="anaData" :title="'系統'" :data-name="'system'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
            <PieChart :ana-data="anaData" :title="'瀏覽器'" :data-name="'browser'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
            <PieChart :ana-data="anaData" :title="'語系'" :data-name="'lang'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
            <PieChart :ana-data="anaData" :title="'裝置'" :data-name="'device'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
            <PieChart :ana-data="anaData" :title="'導流網址'" :data-name="'refer'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
        </div>
    </div>
    
</template>

<script>
// import LineChart from "@/components/widgets/analysis/LineChart";
import PieChart from "@/components/widgets/analysis/pieChart/PieChartMain";
import moment from "moment";
import trackApi from "@/api/track/TrackApi";
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
        PieChart
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
                model_id: isProd() ? window.pid : this.$store.state.pageId,
                start_at: this.startAt,
                end_at: this.endAt,
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
