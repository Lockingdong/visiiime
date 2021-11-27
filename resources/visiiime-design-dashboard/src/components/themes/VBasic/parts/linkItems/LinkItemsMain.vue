<template>
    <div :class="[$style['main-links'], $style[layoutName]]">
        <div :class="[$style['main-links-wrapper']]">
            <link-item-main v-for="(item, idx) in linkItems.list" :is-demo="isDemo" :key="idx" :link-item-link="item.link" :link-item="item" :style="linkStyle" @open-media-window="openMediaWindow" @open-pwd-form="openPwdForm" />
        </div>
    </div>
</template>

<script>
import linkItemMain from "./linkItemMain/LinkItemMain";
export default {
    props: {
        linkItems: {
            type: Object,
            required: true,
        },
        layoutName: {
            type: String,
            required: true,
        },
        isDemo: {
            type: Boolean,
            default: false,
        },
        textColor: {
            type: String,
        },
    },
    components: {
        linkItemMain,
    },
    computed: {
        linkStyle() {
            if (this.textColor === "") {
                return {};
            }

            return {
                color: this.textColor,
            };
        },
    },
    methods: {
        openMediaWindow(payload) {
            this.$emit("open-media-window", payload);
        },
        openPwdForm(payload) {
            this.$emit("open-pwd-form", payload);
        },
    },
    mounted() {},
};
</script>
<style lang="scss" module>
@import "./LinkItemCustom.scss";
@import "../../layout/linksMain";
.main-links {
    justify-content: center;
    margin: 0 auto;
    padding: 5px;
}

.main-links-wrapper {
    // display: flex;
    padding: 10px 0;
    overflow-x: scroll;
    // white-space: nowrap;
    text-align: center;

    ::-webkit-scrollbar {
        display: none;
    }

}

</style>
