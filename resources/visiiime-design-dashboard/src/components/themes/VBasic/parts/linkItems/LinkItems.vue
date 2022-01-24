<template>
    <div :class="$style['links']">
        <div :class="$style['list']">
            <div v-for="(item, idx) in linkItems.list" :key="idx" :class="linkItemClass(idx)">
                <linkItem :link-item="item" :text-color="textColor" :is-demo="isDemo" :link-button="linkButton" @open-media-window="openMediaWindow" @open-pwd-form="openPwdForm" />
            </div>
        </div>
    </div>
</template>

<script>
import linkItem from "./linkItem/LinkItem.vue";

export default {
    props: {
        linkItems: {
            type: Object,
            required: true,
        },
        linkButton: {
            type: Object,
            required: true
        },
        textColor: {
            type: String,
        },
        isDemo: {
            type: Boolean,
            required: true
        }
    },
    components: {
        linkItem,
    },
    methods: {
        openMediaWindow(payload) {
            this.$emit("open-media-window", payload);
        },
        openPwdForm(payload) {
            this.$emit("open-pwd-form", payload);
        },
        linkItemClass(idx) {
            return {
                [this.$style['link-wrapper']]: true,
                [this.$style['link-wrapper-50']]: this.linkItems.list[idx].linkColMode === '50'
            }
        }
    },
    mounted() {},
};
</script>
<style lang="scss" module>
.list {
    padding: 5px;
    display: flex;
    flex-wrap: wrap;
    margin: 0 auto;
    padding: 10px;
    justify-content: space-between;
}

.link-wrapper {
    width: 100%;
    margin-bottom: 12px;
}

.link-wrapper-50 {
    width: 48.5%;
}

.item {
    text-align: center;
}
.links {
    margin-bottom: 20px;
}
</style>
