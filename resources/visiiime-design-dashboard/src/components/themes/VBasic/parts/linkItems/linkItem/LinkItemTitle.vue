<template>
    <div :class="titleClass" :style="{color: titleTextColor}">
        {{ linkItem.linkName }}
    </div>
</template>

<script>
export default {
    data() {
        return {
        };
    },
    props: {
        linkItem: {
            type: Object,
            required: true,
        },
        linkButton: {
            type: Object,
            required: true,
        },
        textColor: {
            type: String,
        },
    },
    computed: {
        titleTextColor() {
            if(this.textColor === '' || this.textColor === null) {
                return null;
            }

            return this.textColor;
        },
        titleClass() {
            return {
                [this.$style['title']]: true
            }
        }
    },
    mounted() {
    },
};
</script>
<style lang="scss" module>
@import '../../../layout/links';

.title {
    text-align: center;
    font-size: 20px;
    margin-bottom: -2px;
    color: inherit;
}
</style>
