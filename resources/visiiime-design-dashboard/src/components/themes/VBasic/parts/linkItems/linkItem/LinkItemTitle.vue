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
        layoutName: {
            type: String,
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
    font-size: 18px;
    margin-bottom: -8px;
    color: inherit;
}
</style>
