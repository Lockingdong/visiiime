<template>
    <div :class="$style['main-link-wrapper']">
        <a @click="linkClick" :href="linkItem.link" target="_blank" :class="animationClass">
            
            <div 
                v-if="checkIsIcon(linkItem.thumbnail)"
                :style="{
                    backgroundColor: buttonBgColor,
                    color: buttonTextColor,
                }"
            >
                <vs-icon 
                    :icon-name="`${linkItem.thumbnail}`" 
                    :svg-size="65"
                />
            </div>
            <div
                v-else-if="['', null].includes(linkItem.thumbnail)"
                :style="{
                    backgroundColor: buttonBgColor,
                    color: buttonTextColor,
                }"
            >
                <vs-icon 
                    :icon-name="`${'sr-link'}`" 
                    :svg-size="65"
                />
            </div>
            <img 
                v-else
                :class="$style['main-link-img']" :src="linkItem.thumbnail" 
            />

        </a>
        <div :class="$style['title']">{{linkItem.linkName}}</div>
    </div>
</template>

<script>
import VsIcon from "../../../../../../components/icon/VsIcon.vue";
import trackApi from '../../../../../../api/track/TrackApi'
import { linkType as linkTypeEnum, mediaOpenType as mediaOpenTypeEnum, linkEvent, modelName } from "../../../../../../enum/vo/LinkItemEnum";
import { isProd } from '../../../../../../helper/env'
import { checkIsIcon } from '../../../../../../helper/iconNameChecker'
export default {
    components: {
        VsIcon
    },
    props: {
        linkItem: {
            type: Object,
            required: true,
        },
        isDemo: {
            type: Boolean,
            required: true
        },
        buttonBgColor: {
            type: String,
        },
        buttonTextColor: {
            type: String,
        }
    },
    computed: {
        animationClass() {

            return {
                [this.$style["link-animation"]]: true,
                [this.$style[this.linkItem.linkCustomData.linkAnimation]]: this.linkItem.linkCustomData.linkAnimation !== "",
                [this.$style['main-link']]: true

            }
        },
        linkItemThumbnail() {

            if(this.linkItem.thumbnail === null || this.linkItem.thumbnail === '') {
                return this.linkItem.thumbnail;
            }

            if(this.linkItem.thumbnail.indexOf('cb-') !== -1) {
                return require(`../../../../../../assets/icons/png/color/brand/${this.linkItem.thumbnail}.png`)
            }
            return this.linkItem.thumbnail;
        }
    },
    methods: {
        linkClick($event) {
            $event.preventDefault();
            try {
                if(!this.isDemo) {
                    trackApi.eventCreate({
                        model_id: this.linkItem.id,
                        model_parent_id: isProd() ? window.pid : this.$store.state.pageId,
                        model_name: modelName.vlinkItemMain,
                        event_type: linkEvent.click,
                        vd: window.vd
                    }).then(() => {

                    }).catch(e => {
                        console.log(e)
                    })
                }
                
            } catch (error) {
                console.log(error)
            }

            if(this.linkItem.linkPwd !== null && this.linkItem.linkPwd !== '') {
                
                this.$emit("open-pwd-form", {
                    linkId: this.linkItem.id,
                });
                return
            }

            let mediaOpenType = this.linkItem.mediaOpenType;
            let linkType = this.linkItem.linkType;

            if (mediaOpenType !== undefined &&
                mediaOpenType === mediaOpenTypeEnum.inr &&
                linkType === linkTypeEnum.media
                ) {

                this.$emit("open-media-window", {
                    link: this.linkItem.link,
                    mediaName: this.linkItem.mediaName,
                });

                return;
            }

            window.open(this.linkItem.link, '_blank')

        },
        checkIsIcon(iconName) {
            return checkIsIcon(iconName)
        }
    },
};
</script>
<style lang="scss" module>
@import '../LinkItemCustom';
@import '../../../layout/linksMain';
@import '../../../layout/customLink';

.title {
    margin-top: 8px;
    font-size: 13px;
    color: inherit;
    width: 60px;
    display: inline-block;

}


.main-link-wrapper {
    display: inline-block;
    // display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0 10px;
    // display: inline-block;
    vertical-align: top; /* here */
}

.main-link {
    width: 65px;
    height: 65px;
}

.main-link-img {
    width: 65px;
    height: 65px;
    object-fit: cover;
    border-radius: 50%;
}
</style>
