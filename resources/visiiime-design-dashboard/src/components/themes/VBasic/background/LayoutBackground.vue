<template>
    <div :class="bgClass" :style="layoutBackGroundImage">
    </div>
</template>
<script>
import { isProd, baseUrl } from "../../../../helper/env"

export default {
    data() {
        return {
            windowWidth: window.innerWidth,
        }
    },
    props: {
        layoutName: {
            type: String,
            required: true,
        },
        isDemo: {
            type: Boolean,
            required: true
        }
    },
    computed: {
        bgClass() {
            return [
                this.$style['background'],
                this.$style[this.layoutName],
                this.isDemo ? this.$style['bdrs'] : ''
            ]
        },
        layoutBackGroundImage() {
            let style = {};
            let layoutName = this.layoutName;
            let hasBgLayout = ["elegant", "naughty", "waterColor"];
            let url = isProd() ? '' : baseUrl();
            if (hasBgLayout.includes(layoutName)) {
                if (this.windowWidth <= 768) {
                    style.backgroundImage = `url(${url}/VBasic/${layoutName}.png)`;
                } else {
                    // 如果是在編輯頁 背景只有手機版尺寸
                    if (this.isDemo) {
                        style.backgroundImage = `url(${url}/VBasic/${layoutName}.png)`;
                    } else {
                        style.backgroundImage = `url(${url}/VBasic/${layoutName}-d.png)`;
                    }
                }
            }
            return style;
        },
    },
    methods: {
        onResize() {
            this.windowWidth = window.innerWidth;
        },
    },
    mounted() {
        this.$nextTick(() => {
            window.addEventListener("resize", this.onResize);
        });
    },
    beforeDestroy() {
        window.removeEventListener("resize", this.onResize);
    },
};
</script>

<style lang="scss" module>
@import "../layout/bg";

.bdrs {
    border-radius: 30px;
}

.background {

    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    z-index: -1;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}
</style>
