<template>
    <div class="mb-3">
        <div class="text-center bg-gray-500 text-white py-1">連結特效</div>
        <div v-if="hasPermission" class="p-5">
            <div class="grid grid-cols-3 gap-4">
                <button class="btn" :class="noneBtnClass" @click="setAnimation('')">無</button>
                <button class="btn" :class="bounceBtnClass" @click="setAnimation('bounce')">bounce</button>
                <button class="btn" :class="shakeBtnClass" @click="setAnimation('shake')">shake</button>
                <button class="btn" :class="pulseBtnClass" @click="setAnimation('pulse')">pulse</button>
                <button class="btn" :class="rubberBandBtnClass" @click="setAnimation('rubberBand')">rubberBand</button>
                <button class="btn" :class="wobbleBtnClass" @click="setAnimation('wobble')">wobble</button>
            </div>
            <div class="flex justify-center mt-3">
                <button v-show="showSaveBtn" @click="updateAnimation" class="btn btn-primary">儲存</button>
            </div>
        </div>
        <div v-else class="p-5">
            <normal-alert></normal-alert>
        </div>
    </div>
</template>
<script>
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";

import { CAN_USE_LINK_ITEM_DBOARD_STAR } from "@/enum/permission/vBasic/VPermission";
import NormalAlert from "@/components/widgets/permission/NormalAlert";

export default {
    data() {
        return {
            showSaveBtn: false
        };
    },
    components: {
        NormalAlert
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
        hasPermission() {
            return this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_DBOARD_STAR);
        },
        linkAnimation() {
            return this.linkItem.linkCustomData.linkAnimation;
        },
        noneBtnClass() {
            if (this.linkAnimation === "" || this.linkAnimation === null) {
                return [this.$style["link-animation"]];
            }

            return [this.$style["link-animation"], 'btn-outline'];
        },
        bounceBtnClass() {
            if (this.linkAnimation === "bounce") {
                return [this.$style["link-animation"], this.$style["bounce"]];
            }
            return [this.$style["link-animation"], 'btn-outline'];
        },
        shakeBtnClass() {
            if (this.linkAnimation === "shake") {
                return [this.$style["link-animation"], this.$style["shake"]];
            }
            return [this.$style["link-animation"], 'btn-outline'];
        },
        pulseBtnClass(){
            if(this.linkAnimation === 'pulse'){
                return[this.$style["link-animation"], this.$style["pulse"]];
            }
            return [this.$style["link-animation"], 'btn-outline'];
        },
        rubberBandBtnClass(){
            if(this.linkAnimation === 'rubberBand'){
                return[this.$style["link-animation"], this.$style["rubberBand"]];
            }
            return [this.$style["link-animation"], 'btn-outline'];
        },
        wobbleBtnClass(){
            if(this.linkAnimation === 'wobble'){
                return[this.$style["link-animation"], this.$style["wobble"]];
            }
            return [this.$style["link-animation"], 'btn-outline'];
        }
    },
    methods: {
        setAnimation(className) {
            this.linkItem.linkCustomData.linkAnimation = className;
            // this.$emit('link-item-update', {
            //     field: 'link_custom_data',
            //     data: this.linkItem.linkCustomData
            // })
        },
        updateAnimation() {

            vBasicLinkItemApi.linkItemUpdate({
                id: this.linkItem.id,
                field: 'link_custom_data',
                data: this.linkItem.linkCustomData,
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

        }
    },
    mounted() {
        this.$watch('linkAnimation', () => {
            this.showSaveBtn = true;
        });
    }
};
</script>

<style lang="scss" module>
@import "@/components/themes/VBasic/parts/linkItems/LinkItemCustom.scss";
</style>
