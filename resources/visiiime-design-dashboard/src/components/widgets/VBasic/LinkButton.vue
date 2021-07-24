<template>
    <span :class="btnClass" v-on="$listeners">
        {{ text }}
    </span>
</template>

<script>
import { buttonClassMapping } from "@/components/themes/VBasic/ClassMapping";
export default {
    props: {
        filled: {
            type: Boolean,
            default: true,
        },
        colorDark: {
            type: Boolean,
            default: false,
        },
        text: {
            type: String,
            required: true,
        },
        buttonName: {
            type: String,
        },
        buttonBorder: {
            type: String,
        },
        buttonRadius: {
            type: String,
        },
    },
    computed: {
        btnClass() {

            // return [
            //     buttonClassMapping[this.buttonName],
            //     this.$style[this.buttonBorder],
            //     this.$style["btn"], this.filled ? this.$style["bgc"] : "",
            //     this.colorDark ? this.$style["color-dark"] : ""
            // ];

            return {
                [this.$style["btn"]]: true,
                [buttonClassMapping[this.buttonName]]: true,
                [this.$style["color-dark"]]: this.colorDark,
                [this.$style[this.buttonBorder]]: this.buttonBorder !== "",
                [this.$style[this.buttonRadius]]: this.buttonRadius !== ""
            }
        },
    },
};
</script>
<style lang="scss" module>
@import "@/components/themes/VBasic/layout/customLink/index.scss";
@import "@/components/themes/VBasic/layout/customLink/border/index.scss";
@import "@/components/themes/VBasic/layout/customLink/radius/index.scss";

.btn {
    // margin: 0 20px;
    border: 1px solid #333;
    color: #fff;

    display: inline-block;
    padding: 10px;
    width: 80%;
    text-align: center;
    box-sizing: border-box;
}

.bgc {
    background-color: #333;
}

.color-dark {
    color: #333;
}
</style>
