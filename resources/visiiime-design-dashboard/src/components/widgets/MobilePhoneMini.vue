<template>
    <div v-if="loaded" class="phone-outter" :class="{ phoneBorder: outterFrame }">
        <div class="min-phone relative">
            <custom-background :background="layoutData.background" :is-demo="true"/>

            <div class="flex justify-center flex-col items-center absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-11/12">
                <div :style="buttonStyle" class="h-5 mb-1 border w-full"></div>
                <div :style="buttonStyle" class="h-5 mb-1 border w-full"></div>
                <div :style="buttonStyle" class="h-5 border w-full"></div>
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
        previewImage: {
            type: String,
            required: true,
        },
        outterFrame: {
            type: Boolean,
            default: false,
        },
        backgroundColor: {
            type: String,
            default: ''
        },
        layoutCode: {
            type: String,
            default: ''
        }
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
        let layout = new LayoutVO(this.layoutCode, this.layoutCode);

        let data = await layout.getLayoutData();

        this.layoutData = data;

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
