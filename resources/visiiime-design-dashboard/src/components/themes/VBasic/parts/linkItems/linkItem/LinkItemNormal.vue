<template>
    <a :href="linkItem.link" target="_blank" :class="linkClass" :style="buttonColor">
        <template v-if="linkItem.linkImgMode === 'BIG'">
            <div :class="{
                [$style[linkButton.buttonRadius]]: linkButton.buttonRadius !== '',
            }" :style="{overflow: 'hidden'}">
                <div :class="{[$style['img-wrapper']]: true}">
                    <img :class="$style['img']" :src="linkItemThumbnail" alt="">
                </div>
                <div :class="{[$style['big-img-link-name']]: true,}" :style="buttonColor">
                    {{ linkItem.linkName }}
                </div>
            </div>
        </template>
        <template v-else>
            <div 
                v-if="checkIsIcon(linkItem.thumbnail)"
                :class="imageClass"    
                :style="buttonColor"
            >
                <vs-icon 
                    :icon-name="`${linkItem.thumbnail}`" 
                    :svg-size="38"
                />
            </div>
            <div
                v-else-if="['', null].includes(linkItem.thumbnail)"
            >
            </div>
            <div v-else :class="imageClass">
                <img style="width: 100%" :class="$style['img']" :src="linkItem.thumbnail"/>
            </div>
            
            <div :class="$style['link-name']">{{ linkItem.linkName }}</div>
            <div v-if="isPwdLink" :class="$style['indicator-class']">
                <svg style="width:12px;height:12px" aria-hidden="true" focusable="false" data-prefix="fa" data-icon="lock" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="cursor-pointer svg-inline--fa fa-lock fa-w-14 text-xl"><path data-v-6fa78c20="" fill="currentColor" d="M400 224h-24v-72C376 68.2 307.8 0 224 0S72 68.2 72 152v72H48c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V272c0-26.5-21.5-48-48-48zm-104 0H152v-72c0-39.7 32.3-72 72-72s72 32.3 72 72v72z" class=""></path></svg>
            </div>
        </template>

    </a>
</template>

<script>
import VsIcon from "../../../../../../components/icon/VsIcon.vue";
import { buttonClassMapping } from "../../../ClassMapping";
import { checkIsIcon } from '../../../../../../helper/iconNameChecker'
import { baseUrl } from "../../../../../../helper/env";
export default {
    components: {
        VsIcon
    },
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
        linkButton: {
            type: Object,
            required: true,
        },
        isPwdLink: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        linkClass() {

            if(this.linkItem.linkImgMode === 'BIG') {
                return {
                    [this.$style['big-image-link']]: true,
                    [this.$style[this.linkButton.buttonBorder]]: this.linkButton.buttonBorder !== "",
                    [this.$style[this.linkButton.buttonRadius]]: this.linkButton.buttonRadius !== ""
                }

            }

            return {
                [this.$style['link']]: true,
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
                borderStyle: 'solid'
            };

            Object.keys(buttonStyle).forEach((key) => {
                if (buttonStyle.key === "") {
                    delete buttonStyle.key;
                }
            });
            return buttonStyle;

        },
        linkItemThumbnail() {

            if(['', null].includes(this.linkItem.thumbnail)) {
                return baseUrl() + '/VBasic/visiiime-default-bg.png'
            }
            
            return this.linkItem.thumbnail;
        },
        
    },
    methods: {
        checkIsIcon(iconName) {
            return checkIsIcon(iconName)
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
    justify-content: center
    align-items: center

.image
    position: absolute
    width: 37px
    height: 37px
    left: 4px
    top: 50%
    transform: translateY(-50%)
    background-size: cover
    background-position: center center
    transition: .3s
    overflow: hidden

.indicator-class 
    position: absolute
    width: 37px
    // height: 37px
    right: 3px
    top: 50%
    transform: translateY(-50%)

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
