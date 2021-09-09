<template>
    <a :href="linkItem.link" target="_blank" :class="linkClass" :style="buttonColor">
        <template v-if="linkItem.linkImgMode === 'BIG'">
            <div :class="{
                [$style[linkButton.buttonRadius]]: linkButton.buttonRadius !== '',
            }" :style="{overflow: 'hidden'}">
                <div :class="{
                    [$style['img-wrapper']]: true,
                }">
                    <img :class="$style['img']" :src="linkItemThumbnail" alt="">
                </div>
                <div :class="{
                    [$style['big-img-link-name']]: true,
                }" :style="buttonColor">{{ linkItem.linkName }}</div>
            </div>
        </template>
        <template v-else>
            <div
                v-if="linkItemThumbnail !== '' && linkItemThumbnail !== null"
                :class="imageClass"
                :style="{ backgroundImage: 'url(' + linkItemThumbnail + ')' }
            ">
            </div>
            <div :class="$style['link-name']">{{ linkItem.linkName }}</div>
        </template>

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

            if(this.linkItem.linkImgMode === 'BIG') {
                return {
                    [this.$style[this.layoutName]]: true,
                    [this.$style['big-image-link']]: true,
                    [this.$style[this.linkButton.buttonBorder]]: this.linkButton.buttonBorder !== "",
                    [this.$style[this.linkButton.buttonRadius]]: this.linkButton.buttonRadius !== ""
                }

            }

            return {
                [this.$style['link']]: true,
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
        linkItemThumbnail() {

            if(this.isThumbnailCbIcon) {
                return require(`../../../../../../assets/icons/png/color/brand/${this.linkItem.thumbnail}.png`)
            }
            return this.linkItem.thumbnail;
        },
        isThumbnailCbIcon() {
            if(this.linkItem.thumbnail === null || this.linkItem.thumbnail === '') {
                return false;
            }

            if(this.linkItem.thumbnail.indexOf('cb-') !== -1) {
                return true;
            }

            return false;
        }
    },
    mounted() {
    },
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

.link
    width: 100%
    height: 100%
    display: flex
    justify-content: space-between
    align-items: center

.image
    // position: absolute
    width: 35px
    height: 35px
    // left: 5px
    // top: 50%
    // transform: translateY(-50%)
    background-size: cover
    background-position: center center
    transition: .3s
    flex: none

.link-name
    flex-grow: 1


.big-image-link
    .img-wrapper
        position: relative
        padding-bottom: 56.25%
        overflow: hidden
        box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 8px 0px
        background-color: #fff
        .img
            position: absolute
            height: 100%
            top: 50%
            left: 50%
            transform: translate(-50%, -50%)


    .big-img-link-name
        text-align: center
        font-size: 14px
        margin-top: 6px
        margin-bottom: 6px
        padding: 0 5px
</style>
