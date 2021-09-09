<template>
    <v-ob ref="vob" tag="div" class="mb-3">
        <div class="text-center bg-gray-500 text-white py-1">排程</div>
        <div v-if="hasPermission" class="p-5">
            <v-p v-slot="{ errors }" :rules="startAtRule" name="顯示時間" class="form-control" tag="div">
                <label class="label">
                    <span class="label-text">顯示時間</span>
                </label>
                <input
                    type="datetime-local"
                    :min="today"
                    :value="startAt"
                    @input="startAt = $event.target.value"
                    :class="{'input-error': errors.length !== 0}"
                    class="input input-sm input-bordered"
                >
                <div>
                    <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                </div>
            </v-p>
            <v-p v-slot="{ errors }" :rules="endAtRule" name="結束時間" class="form-control" tag="div">
                <label class="label">
                    <span class="label-text">結束時間</span>
                </label>
                <input
                    type="datetime-local"
                    :min="startAt"
                    :value="endAt"
                    @input="endAt = $event.target.value"
                    :class="{'input-error': errors.length !== 0}"
                    class="input input-sm input-bordered"
                >
                <div>
                    <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                </div>
            </v-p>
            <div class="flex justify-center mt-3">
                <button v-show="showClearBtn" @click="openClearDatetimeForm" class="btn mr-3">清除</button>
                <button v-show="showSaveBtn" @click="updateDatetime" :class="{loading: loading}" class="btn btn-primary">儲存</button>
            </div>
        </div>
        <div v-else class="p-5">
            <!-- todo -->
            You don't have the permission.
        </div>
        <confirm-modal
            :modal-name="confirmModalName"
            @confirm="clearDatetime"
        />
    </v-ob>
</template>
<script>
import { ValidationProvider as VP } from "vee-validate";
import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";

import "vue2-datepicker/index.css";
import DatePicker from "vue2-datepicker";
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import dateformat from "dateformat";
import ConfirmModal from "@/components/widgets/upload/ConfirmModal";
import { CAN_USE_LINK_ITEM_DBOARD_SCHEDULE } from "@/enum/permission/vBasic/VPermission";


export default {
    data() {
        return {
            showSaveBtn: false,
            loading: false,
            startAt: '',
            endAt: '',
        };
    },
    components: {
        DatePicker,
        ConfirmModal,
        VP,
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
        confirmModalName() {
            return "linkItemConfirmDatetime" + this.linkItem.id;
        },
        hasPermission() {
            return this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_DBOARD_SCHEDULE);
        },
        today() {
            const today = new Date();
            return dateformat(today, "yyyy-mm-dd'T'HH:MM");
        },
        startAtRule() {
            if(this.endAt !== '' && this.endAt !== null) {
                return 'required';
            }

            return '';

        },
        endAtRule() {
            if(this.startAt !== '' && this.startAt !== null) {
                return 'required';
            }

            return '';
        },
        showClearBtn() {
            if((this.startAt === null || this.startAt === '') && (this.endAt === null || this.endAt === '')) {
                return false;
            }

            return true;
        },
        startAtAndEndAt() {
            return [this.startAt, this.endAt];
        }
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
        formatTime(datetime) {

            if(datetime === '' || datetime === null) {
                return '';
            }

            return dateformat(datetime, "yyyy-mm-dd'T'HH:MM");
        },
        async updateDatetime() {

            const res = await this.$refs.vob.validate()

            if(res) {
                vBasicLinkItemApi.linkItemStartEndTimeUpdate({
                    id: this.linkItem.id,
                    start_at: this.startAt,
                    end_at: this.endAt,
                })
                .then(rs => {

                    this.$modal.show('result-modal', {
                        header: '更新成功'
                    })
                    this.linkItem.startAt = this.startAt;
                    this.linkItem.endAt = this.endAt;

                    this.showSaveBtn = false;


                }).catch(error => {
                    console.log(error)
                    this.$modal.show('result-modal', {
                        header: '發生錯誤'
                    })
                })
            }
        },
        openClearDatetimeForm() {
            this.$modal.show(this.confirmModalName, {
                header: '清除排程',
                content: '您確定要刪除嗎？ 此動作無法復原。'
            });
        },
        clearDatetime() {

            vBasicLinkItemApi.linkItemStartEndTimeUpdate({
                id: this.linkItem.id,
                start_at: '',
                end_at: '',
            }).then(rs => {

                this.$modal.show('result-modal', {
                    header: '清除成功'
                })
                this.linkItem.startAt = '';
                this.linkItem.endAt = '';

                this.startAt = '';
                this.endAt = '';

            }).catch(error => {
                console.log(error)
                this.$modal.show('result-modal', {
                    header: '發生錯誤'
                })
            })
        }
    },
    watch: {
        // startAt(nv) {
        //     if (nv !== "" && nv > new Date(this.linkItem.endAt)) {
        //         this.linkItem.endAt = "";
        //     }
        // },
        // endAt(nv) {
        //     if (nv !== "" && nv < new Date(this.linkItem.startAt)) {
        //         this.linkItem.startAt = "";
        //     }
        // },
    },
    mounted() {
        this.startAt = this.formatTime(this.linkItem.startAt);
        this.endAt = this.formatTime(this.linkItem.endAt);

        this.$watch('startAtAndEndAt', () => {
            this.showSaveBtn = true;
        });
    }
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
