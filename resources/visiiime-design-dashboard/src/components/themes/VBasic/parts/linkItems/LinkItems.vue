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
    a
        border: 1px solid rgba(#333, 0.8)
        display: inline-block
        padding: 12px 30px
        max-width: 500px
        width: 90%
        margin-bottom: 15px
        transition: .3s
        border-radius: 5px
        min-height: 35px
        font-size: 17px
        // &:hover
        //   // background-color: #333
        //   // color: #fff
</style>
