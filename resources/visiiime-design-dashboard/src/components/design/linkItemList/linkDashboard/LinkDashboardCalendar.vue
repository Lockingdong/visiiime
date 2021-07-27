<template>
    <div class="mb-3">
        <div class="text-center bg-gray-500 text-white py-1">schedule</div>
        <div class="p-5">
            <div class="flex justify-start items-center mb-3">
                <div class="mr-3 w-16">start at</div>
                <div class="mr-3">
                    <date-picker v-model.lazy="startAt" type="datetime" :disabled-date="startAtDisabled"></date-picker>
                </div>
                <!-- <div class="underline" @click="clearTime('startAt')">clear</div> -->
            </div>
            <div class="flex justify-start items-center">
                <div class="mr-3 w-16">end at</div>
                <div class="mr-3">
                    <date-picker v-model.lazy="endAt" type="datetime" :disabled-date="endAtDisabled"></date-picker>
                </div>
                <!-- <div class="underline" @click="clearTime('endAt')">clear</div> -->
            </div>
        </div>
    </div>
</template>
<script>
import "vue2-datepicker/index.css";
import DatePicker from "vue2-datepicker";
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import dateformat from "dateformat";
export default {
    data() {
        return {};
    },
    components: {
        DatePicker,
    },
    props: {
        linkItem: {
            type: LinkItemVO,
            required: true,
        },
        idx: {
            type: Number,
            required: true,
        },
    },
    computed: {
        startAt: {
            get() {
                if (this.linkItem.startAt === null || this.linkItem.startAt === "") {
                    return "";
                }
                return new Date(this.linkItem.startAt);
            },
            set(val) {
                if (val === null || val === "") {
                    this.linkItem.startAt = "";
                } else {
                    let date = new Date(val);
                    this.linkItem.startAt = dateformat(date, "yyyy-mm-dd HH:MM:ss");
                }
                // this.$emit('link-item-update', {
                //     field: 'start_at',
                //     data: this.linkItem.startAt
                // })
            },
        },
        endAt: {
            get() {
                if (this.linkItem.endAt === null || this.linkItem.endAt === "") {
                    return "";
                }
                return new Date(this.linkItem.endAt);
            },
            set(val) {
                if (val === null || val === "") {
                    this.linkItem.endAt = "";
                } else {
                    let date = new Date(val);
                    this.linkItem.endAt = dateformat(date, "yyyy-mm-dd HH:MM:ss");
                }
                // this.$emit('link-item-update', {
                //     field: 'end_at',
                //     data: this.linkItem.endAt
                // })
            },
        },
    },
    methods: {
        startAtDisabled(date) {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return date < today;
        },
        endAtDisabled(date) {
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            return date < this.startAt;
        },
        clearTime(time) {
            if (time === "startAt") {
                this.linkItem.startAt = "";
                return;
            }
            this.linkItem.endAt = "";
        },
    },
    watch: {
        startAt(nv) {
            if (nv !== "" && nv > new Date(this.linkItem.endAt)) {
                this.linkItem.endAt = "";
            }
        },
        endAt(nv) {
            if (nv !== "" && nv < new Date(this.linkItem.startAt)) {
                this.linkItem.startAt = "";
            }
        },
    },
};
</script>
<style lang="scss">
    .mx-calendar {
        width: 280px !important;
        .cell.not-current-month {
            color: #999;
        }
    }
</style>
