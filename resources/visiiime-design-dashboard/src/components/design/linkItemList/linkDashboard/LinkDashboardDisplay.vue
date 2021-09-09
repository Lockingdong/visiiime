<template>
    <div>
        <div class="text-center bg-gray-500 text-white py-1">顯示設定</div>
        <div v-if="hasPermission" class="p-5">
            <div class="form-control w-1/3">
                <label class="cursor-pointer label">
                    <input v-model="linkItem.linkImgMode" :true-value="'BIG'" :false-value="''" type="checkbox" checked="checked" class="checkbox checkbox-primary">
                    <span class="label-text">大圖顯示</span>
                </label>
            </div>
            <div class="form-control w-1/3">
                <label class="cursor-pointer label">
                    <input v-model="linkItem.linkColMode" :true-value="'50'" :false-value="''" type="checkbox" checked="checked" class="checkbox checkbox-primary">
                    <span class="label-text">佔比一半</span>
                </label>
            </div>
            <div class="flex justify-center mt-3">
                <button v-show="showSaveBtn" @click="updateDisplay" :class="{loading: loading}" class="btn btn-primary">儲存</button>
            </div>

        </div>
        <div v-else class="p-5">
            <!-- todo -->
            You don't have the permission.
        </div>
    </div>
</template>
<script>
import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";

import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import ConfirmModal from "@/components/widgets/upload/ConfirmModal";
import { CAN_USE_LINK_ITEM_DBOARD_SCHEDULE } from "@/enum/permission/vBasic/VPermission";


export default {
    data() {
        return {
            showSaveBtn: false,
            loading: false,
        };
    },
    components: {
        ConfirmModal,
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
        display() {
            return {
                linkImgMode: this.linkItem.linkImgMode,
                linkColMode: this.linkItem.linkColMode
            };
        },
        hasPermission() {
            // todo
            return this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_DBOARD_SCHEDULE);
        },
    },
    methods: {
        updateDisplay() {
            vBasicLinkItemApi.linkItemDisplayUpdate({
                id: this.linkItem.id,
                link_img_mode: this.linkItem.linkImgMode,
                link_col_mode: this.linkItem.linkColMode,
            })
            .then(rs => {

                this.$modal.show('result-modal', {
                    header: '更新成功'
                })

                this.showSaveBtn = false;


            }).catch(error => {
                console.log(error)
                this.$modal.show('result-modal', {
                    header: '發生錯誤'
                })
            })
        },
    },
    watch: {
    },
    mounted() {
        this.$watch('display', () => {
            this.showSaveBtn = true;
        }, { deep: true });
    }
};
</script>
<style lang="scss">
</style>
