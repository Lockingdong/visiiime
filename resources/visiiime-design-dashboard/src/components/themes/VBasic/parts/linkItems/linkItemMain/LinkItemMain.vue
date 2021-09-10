<template>
    <div :class="$style['main-link-wrapper']">
        <a @click="linkClick" :href="linkItem.link" target="_blank" :class="animationClass">
            <img :class="$style['main-link-img']" :src="linkItemThumbnail" />
        </a>
        <div :class="$style['title']">{{linkItem.linkName}}</div>
    </div>
</template>

<script>
import trackApi from '../../../../../../api/track/TrackApi'
import { linkType as linkTypeEnum, mediaOpenType as mediaOpenTypeEnum } from "../../../../../../enum/vo/LinkItemEnum";
export default {
    props: {
        linkItem: {
            type: Object,
            required: true,
        },
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
            if(!this.isDemo) {
                trackApi.eventCreate({
                    model_id: this.linkItem.id,
                    event_type: 'link_click',
                    v_data: window.vistorData
                }).then(() => {

                }).catch(e => {
                    console.log(e)
                })
            }

            if (this.linkItem.mediaOpenType !== undefined &&
                this.linkItem.mediaOpenType === mediaOpenTypeEnum.inr &&
                this.linkItem.linkType === linkTypeEnum.media
                ) {
                $event.preventDefault();

                this.$emit("open-media-window", {
                    link: this.linkItem.link,
                    mediaName: this.linkItem.mediaName,
                });

                return;
            }
        }
    },
    mounted() {},
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
    display: flex;
    width: 65px;
    height: 65px;
}

.main-link-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}
</style>
