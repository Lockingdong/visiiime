<template>
    <div class="mb-3">
        <div class="text-center bg-gray-500 text-white py-1">連結點擊分析</div>
        <div v-if="hasPermission" class="p-5">
            <LineChart v-if="loaded" :ana-data="anaData" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
            <div class="p-5 pt-5 pb-0 text-center">
                <button 
                    @click="$modal.show(`linkItemChartModal${linkItem.id}`)"
                    class="btn btn-primary"
                >查看更多</button>
            </div>
        </div>
        <div v-else class="p-5">
            <normal-alert></normal-alert>
        </div>

        <modal
            :name="`linkItemChartModal${linkItem.id}`"
            :max-width="600"
            width="90%"
            height="auto"
            :adaptive="true"
        >
            <div class="card shadow-md bg-white py-3 px-4">
                <div class="tabs tabs-boxed justify-center">
                    <span @click="changeChart('country')" :class="{'tab-active': currentChart === 'country'}" class="tab">國家</span> 
                    <span @click="changeChart('browser')" :class="{'tab-active': currentChart === 'browser'}" class="tab">瀏覽器</span> 
                    <span @click="changeChart('system')" :class="{'tab-active': currentChart === 'system'}" class="tab">系統</span>
                    <span @click="changeChart('lang')" :class="{'tab-active': currentChart === 'lang'}" class="tab">語系</span>
                    <span @click="changeChart('device')" :class="{'tab-active': currentChart === 'device'}" class="tab">裝置</span>
                </div>
                <div class="mb-2">
                </div>
                <div>
                </div>
                <div :key="componentKey">
                    <div v-if="currentChart === 'country'">
                        <PieChart :ana-data="anaData" :title="'國家'" :data-name="'country'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
                        
                    </div>
                    <div v-if="currentChart === 'browser'">
                        <PieChart :ana-data="anaData" :title="'瀏覽器'" :data-name="'browser'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
                        
                    </div>
                    <div v-if="currentChart === 'system'">
                        <PieChart :ana-data="anaData" :title="'系統'" :data-name="'system'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
                        
                    </div>
                    <div v-if="currentChart === 'lang'">
                        <PieChart :ana-data="anaData" :title="'語系'" :data-name="'lang'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
                        
                    </div>
                    <div v-if="currentChart === 'device'">
                        <PieChart :ana-data="anaData" :title="'裝置'" :data-name="'device'" :start-at="startAt" :end-at="endAt" class="flex-1 min-w-0" />
                        
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>
<script>
import LineChart from "@/components/widgets/analysis/lineChart/LineChartMain";
import PieChart from "@/components/widgets/analysis/pieChart/PieChartMain";
import moment from "moment";
import trackApi from "@/api/track/TrackApi";
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import NormalAlert from "@/components/widgets/permission/NormalAlert";
import { linkEvent } from "@/enum/vo/LinkItemEnum";
import { CAN_USE_LINK_ITEM_DBOARD_CHART } from "@/enum/permission/vBasic/VPermission";

export default {
    components: {
        LineChart,
        PieChart,
        NormalAlert
    },
    data() {
        return {
            anaData: [],
            currentChart: 'country',
            loaded: false,
            componentKey: 0
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
        startAt() {
            let startAt = moment().subtract(6, "days").format("YYYY-MM-DD");
            return startAt;  
        },
        endAt() {
            let now = moment().format('YYYY-MM-DD');
            return now;
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
        async changeChart(type) {
            this.currentChart = type

            await this.updateComponent()
        },
        async updateComponent() {
            this.componentKey += 1;
        },
        async getData() {
            if(!this.hasPermission) {
                return [];
            }
            let { data } = await trackApi.getEventData({
                model_id: this.linkItem.id,
                start_at: this.startAt,
                end_at: this.endAt,
                event_type: linkEvent.click,
                is_parent: false
            });

            return data;
        },
    },
    async mounted() {

        this.anaData = await this.getData();

        this.loaded = true;
    },
};
</script>

<style lang="scss">
.small {
    max-width: 600px;
    margin:  150px auto;
}
</style>
