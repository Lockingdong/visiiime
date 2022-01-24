<template>
    <div v-if="loaded" class="phone-outter" :class="{ phoneBorder: outterFrame }">
        <div class="min-phone relative">
            <custom-background :background="layoutData.background" :is-demo="true"/>
            <div v-if="layout.layoutRole === 'VVIP'" class="badge badge-sm badge-primary bg-indigo-600 absolute right-1 top-1">
                <span>PRO</span>
            </div> 
            <div class="flex justify-center flex-col items-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-11/12">
                <div :style="buttonStyle" class="h-5 mb-1 border w-full rounded"></div>
                <div :style="buttonStyle" class="h-5 mb-1 border w-full rounded"></div>
                <div :style="buttonStyle" class="h-5 border w-full rounded"></div>
            </div>
        </div>
    </div>
</template>

<script>
import LayoutVO from "@/vo/design/layout/LayoutVO";
import CustomBackground from "@/components/themes/VBasic/background/Background";
export default {
    components: {
        CustomBackground
    },
    data() {
        return {
            loaded: false,
            layoutData: {}
        }
    },
    props: {
        layout: {
            type: Object,
            required: true
        },
        outterFrame: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        buttonStyle() {

            let style = {};
            if(this.layoutData.linkButton.buttonBgColor !== '') {
                style.backgroundColor = this.layoutData.linkButton.buttonBgColor;
            }

            if(this.layoutData.linkButton.buttonTextColor !== '' &&
                this.layoutData.linkButton.buttonBgColor !== ''
            ) {
                style.borderColor = this.layoutData.linkButton.buttonTextColor;
            }

            return style
        }
    },
    async mounted() {

        this.layoutData = JSON.parse(this.layout.layoutSetting);

        this.loaded = true
        
    }
};
</script>

<style lang="scss" scoped>
.min-phone {
    border: 5px solid #333;
    padding-bottom: 150%;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.main-display {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-position: center center;
    background-size: cover;
}

.phone-outter {
    border: 2px solid transparent;
    border-radius: 20px;
    padding: 2px;
}

.phoneBorder {
    border: 2px solid #999;
}
</style>
