<template>
    <div :class="$style['desc']">
        <p :class="$style[layoutName]" :style="{color: getTextColor}">{{description.text}}</p>
    </div>
</template>

<script>
export default {
    props: {
        description: {
            type: Object,
            required: true,
        },
        layoutName: {
            type: String,
            required: true,
        },
        textColor: {
            type: String,
            required: true,
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
@import "../layout/description";
.desc {
    max-width: 250px;
    margin: 0 auto;
    font-size: 13px;
    text-align: center;
    line-height: 19px;
    margin-top: 6px;
}
</style>
