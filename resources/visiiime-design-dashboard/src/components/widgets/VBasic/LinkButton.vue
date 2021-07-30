<template>
    <span :class="btnClass" v-on="$listeners">
        {{ btnText }}
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
            return {
                [this.$style["btn"]]: true,
                [buttonClassMapping[this.buttonName]]: true,
                [this.$style["color-dark"]]: this.colorDark,
                [this.$style[this.buttonBorder]]: this.buttonBorder !== "",
                [this.$style[this.buttonRadius]]: this.buttonRadius !== ""
            }
        },
        btnText() {
            return ''
        }
    },
};
</script>
<style lang="scss" module>
@import "@/components/themes/VBasic/layout/customLink/index.scss";
@import "@/components/themes/VBasic/layout/customLink/border/index.scss";
@import "@/components/themes/VBasic/layout/customLink/radius/index.scss";

.btn {
    // margin: 0 20px;
    border: 1px solid rgb(100, 100, 100);
    color: #fff;
    display: inline-block;
    padding: 25px 0;
    width: 80%;
    text-align: center;
    box-sizing: border-box;
    width: 90%;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 8px 0px;
}

.bgc {
    background-color: #333;
}

.color-dark {
    color: #333;
}
</style>
