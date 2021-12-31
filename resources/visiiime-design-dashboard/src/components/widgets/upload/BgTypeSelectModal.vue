<template>
    <modal
        :name="'BgTypeSelectModal'"
        :max-width="600"
        width="90%"
        height="auto"
        :adaptive="true"
        @before-open="beforeOpen"
    >
        <div v-if="layoutBg !== ''" @click="emitOption('layout')" class="card-body cursor-pointer flex">
            <h2 class="card-title">選擇主題背景</h2>
            <div class="avatar">
                <div class="mb-8 rounded-btn w-24 h-24">
                    <img :src="layoutBg">
                </div>
            </div> 
        </div>
        <div v-if="customBg !== ''" @click="emitOption('custom')" class="card-body cursor-pointer">
            <h2 class="card-title">選擇自訂背景</h2>
        </div>
        <div @click="emitOption('upload')" class="card-body cursor-pointer">
            <h2 class="card-title">上傳新背景</h2>
        </div>
        
    </modal>
</template>

<script>
export default {
    data() {
        return {
            layoutBg: {
                type: String,
            },
            customBg: {
                type: String,
            }
        }
    },
    methods: {
        beforeOpen({ params }) {
            this.layoutBg = params.layoutBg;
            this.customBg = params.customBg;
        },
        emitOption(option) {
            this.$emit('choose-' + option)
        }
    }
}
</script>
