<template>
    <div :class="[$style['title-area']]">
        <div :class="[$style['user-title']]" :style="{color: getTextColor}">{{ userTitle.title }}</div>
    </div>
</template>

<script>
    export default {
        props: {
            userTitle: {
                type: Object,
                required: true,
            },
            textColor: {
                type: String,
                required: true,
            },
            isDemo: {
                type: Boolean,
                default: false,
            },
        },
        computed: {
            getTextColor() {
                if (this.textColor !== "" && this.textColor !== undefined) {
                    return this.textColor;
                }

                return "inherit";
            },
        },
    };
</script>
<style lang="scss" module>
@import "../layout/userTitle";
.title-area {
    margin-top: 10px;
    letter-spacing: 0.1px;
    font-weight: 500;
    text-align: center;
}

.user-title {
    line-height: 22px;
    font-size: 17px;
}
</style>
