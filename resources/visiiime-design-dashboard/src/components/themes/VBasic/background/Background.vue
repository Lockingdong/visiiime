<template>
    <div v-if="background.customBgOn">
        <component :is="bgComponent" :background="background" :class="bgClass" />
    </div>
</template>

<script>

export default {
    props: {
        background: {
            type: Object,
            required: true,
        },
        isDemo: {
            type: Boolean,
            required: true,
        },
    },
    data() {
        return {
            themeName: "Vbasic",
        };
    },
    computed: {
        bgComponent() {
            let bgName = this.background.bgName;
            let BgName = bgName.charAt(0).toUpperCase() + bgName.slice(1);
            return () => import(`./${BgName}`);
        },
        bgType() {
            return this.background.bgType;
        },
        bgName() {
            return this.background.bgName;
        },
        bgColor() {
            return this.background.bgColor;
        },
        content() {
            return this.background.bgImage;
        },
        bgClass() {
            return {
                [this.$style['background-demo']]: this.isDemo,
                [this.$style['background-prod']]: !this.isDemo
            }
        }
    },
};
</script>

<style lang="scss" module>
.background-demo {
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    z-index: -1;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}

.background-prod {
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    z-index: -1;
    position: fixed;
    width: 100vw;
    height: 100vh;
    top: 0;
    left: 0;
}
</style>
