<template>
    <div :class="outline" v-on="$listeners">
        <div :class="btnClass">{{ text }}</div>
    </div>
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
        outterFrame: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        btnClass() {
            return {
                [this.$style["btn"]]: true,
                [buttonClassMapping[this.buttonName]]: true,
                [this.$style["bgc"]]: this.filled,
                [this.$style["color-dark"]]: this.colorDark,
                [this.$style[this.buttonBorder]]: this.buttonBorder !== "",
                [this.$style[this.buttonRadius]]: this.buttonRadius !== ""
            }
        },
        outline() {
            return {
                [this.$style['wrapper']]: true,
                [this.$style['outline']]: this.outterFrame,
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

.outline {
    border: 2px solid #808080;
    border-radius: 2px;
}

.wrapper {
    width: 90%;
}

.btn {
    // margin: 0 20px;
    border: 1px solid rgb(158, 158, 158);
    color: #fff;
    display: inline-block;
    padding: 15px 0;
    text-align: center;
    box-sizing: border-box;
    width: 97%;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 8px 0px;
    margin: 2px;
}

.bgc {
    background-color: #333;
}

.color-dark {
    color: #333;
}
</style>
