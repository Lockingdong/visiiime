<template>
    <a :href="linkItem.link" target="_blank" :class="linkClass" :style="buttonColor">
        {{ linkItem.linkName }}
        <div
            v-if="linkItem.thumbnail !== '' && linkItem.thumbnail !== null"
            :class="imageClass"
            :style="{ backgroundImage: 'url(' + linkItem.thumbnail + ')' }
        ">
        </div>
    </a>
</template>

<script>
import { buttonClassMapping } from "../../../ClassMapping";
export default {
    data() {
        return {
            buttonClassMapping,
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
    },
    computed: {
        linkClass() {
            // if (this.linkButton.buttonName !== "") {
            //     return [this.$style[this.layoutName], this.$style[this.linkButton.buttonName], this.$style["image-link"]];
            // }
            // return [
            //     this.$style[this.layoutName],
            //     this.$style["image-link"],
            //     // (this.linkButton.buttonBorder === "")
            // ];
            return {
                [this.$style[this.layoutName]]: true,
                [this.$style["image-link"]]: true,
                [this.$style[this.linkButton.buttonBorder]]: this.linkButton.buttonBorder !== "",
                [this.$style[this.linkButton.buttonRadius]]: this.linkButton.buttonRadius !== ""
            }
        },
        imageClass() {
            return {
                [this.$style.image]: true,
                [this.$style[this.linkButton.buttonRadius]]: this.linkButton.buttonRadius !== ""
            };
        },
        buttonColor() {
            let buttonStyle = {
                backgroundColor: this.linkButton.buttonBgColor,
                color: this.linkButton.buttonTextColor,
                borderColor: this.linkButton.buttonTextColor,
            };

            Object.keys(buttonStyle).forEach((key) => {
                if (buttonStyle.key === "") {
                    delete buttonStyle.key;
                }
            });
            return buttonStyle;
        },
    },
    mounted() {},
};
</script>
<style lang="sass" module>
@import '../../../layout/links'
@import '../../../layout/customLink'
@import '../../../layout/customLink/border'
@import '../../../layout/customLink/radius'

.image-link
    position: relative
    box-sizing: border-box

.image
    position: absolute
    width: 35px
    height: 35px
    left: 5px
    top: 50%
    transform: translateY(-50%)
    background-size: cover
    background-position: center center
    transition: .3s
</style>
