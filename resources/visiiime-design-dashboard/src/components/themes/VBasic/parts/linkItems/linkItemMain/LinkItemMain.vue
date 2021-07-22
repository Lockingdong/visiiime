<template>
    <div>
        <a :href="linkItem.link" target="_blank" :class="animationClass">
            <img :src="linkItem.thumbnail" />
        </a>
        <span :class="$style['title']">{{linkItem.linkName}}</span>
    </div>
</template>

<script>
export default {
    props: {
        linkItem: {
            type: Object,
            required: true,
        },
    },
    computed: {
        animationClass() {
            if (this.linkItem.linkCustomData.linkAnimation === "") {
                return this.$style["link-animation"];
            }
            return [this.$style["link-animation"], this.$style[this.linkItem.linkCustomData.linkAnimation]];
        },
    },
    mounted() {},
};
</script>
<style lang="sass" module>
@import '../LinkItemCustom'
@import '../../../layout/linksMain'
@import '../../../layout/customLink'

.title
    margin-top: 8px
    font-size: 16px
</style>
