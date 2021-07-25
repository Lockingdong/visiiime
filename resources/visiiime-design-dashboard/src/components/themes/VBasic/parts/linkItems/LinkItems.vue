<template>
    <div :class="$style['links']">
        <div class="list">
            <div v-for="(item, id) in linkItems.list" :key="id" :class="$style['item']">
                <linkItem :link-item="item" :layout-name="layoutName" :link-button="linkButton" @open-media-window="openMediaWindow" @open-collector-form="openCollectorForm" />
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
        layoutName: {
            type: String,
            required: true,
        },
        linkButton: {
            type: Object,
            required: true
        },
    },
    components: {
        linkItem,
    },
    methods: {
        openMediaWindow(payload) {
            this.$emit("open-media-window", payload);
        },
        openCollectorForm(payload) {
            this.$emit("open-collector-form", payload);
        },
    },
    mounted() {},
};
</script>
<style lang="sass" module>
.item
    text-align: center
.links
    margin-bottom: 20px
</style>
