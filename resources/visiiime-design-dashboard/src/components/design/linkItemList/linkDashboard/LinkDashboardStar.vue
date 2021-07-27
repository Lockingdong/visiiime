<template>
    <div class="mb-3">
        <div class="text-center bg-gray-500 text-white py-1">連結特效</div>
        <div class="px-3 pt-6 pb-3 flex content-between">
            <v-button variant="secondary" :class="noneBtnClass" @click="setAnimation('')" class="rounded mr-2 border-2 px-4 py-2 text-center">none</v-button>
            <v-button variant="secondary" :class="bounceBtnClass" @click="setAnimation('bounce')" class="rounded mr-2 border-2 px-4 py-2 text-center">bounce</v-button>
            <v-button variant="secondary" :class="shakeBtnClass" @click="setAnimation('shake')" class="rounded mr-2 border-2 px-4 py-2 text-center">shake</v-button>
        </div>
        <div class="px-3 pb-6 flex content-between">
            <v-button variant="secondary" :class="pulseBtnClass" @click="setAnimation('pulse')" class="rounded mr-2 border-2 px-4 py-2 text-center">pulse</v-button>
            <v-button variant="secondary" :class="rubberBandBtnClass" @click="setAnimation('rubberBand')" class="rounded mr-2 border-2 px-4 py-2 text-center">rubberBand</v-button>
            <v-button variant="secondary" :class="wobbleBtnClass" @click="setAnimation('wobble')" class="rounded mr-2 border-2 px-4 py-2 text-center">wobble</v-button>
        </div>
    </div>
</template>
<script>
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";

export default {
    data() {
        return {};
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
        linkAnimation() {
            return this.linkItem.linkCustomData.linkAnimation;
        },
        noneBtnClass() {
            return [this.$style["link-animation"]];
        },
        bounceBtnClass() {
            if (this.linkAnimation === "bounce") {
                return [this.$style["link-animation"], this.$style["bounce"]];
            }
            return [this.$style["link-animation"]];
        },
        shakeBtnClass() {
            if (this.linkAnimation === "shake") {
                return [this.$style["link-animation"], this.$style["shake"]];
            }
            return [this.$style["link-animation"]];
        },
        pulseBtnClass(){
            if(this.linkAnimation === 'pulse'){
                return[this.$style["link-animation"], this.$style["pulse"]];
            }
            return [this.$style["link-animation"]];
        },
        rubberBandBtnClass(){
            if(this.linkAnimation === 'rubberBand'){
                return[this.$style["link-animation"], this.$style["rubberBand"]];
            }
            return [this.$style["link-animation"]];
        },
        wobbleBtnClass(){
            if(this.linkAnimation === 'wobble'){
                return[this.$style["link-animation"], this.$style["wobble"]];
            }
            return [this.$style["link-animation"]];
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
    },
};
</script>

<style lang="scss" module>
@import "@/components/themes/VBasic/parts/linkItems/LinkItemCustom.scss";
</style>
