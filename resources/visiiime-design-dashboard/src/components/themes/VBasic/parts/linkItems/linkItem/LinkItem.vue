<template>
    <div style="height: 100%">
        <component @click.native="linkClick" :is="linkItemComponent" :link-item="linkItem" :text-color="textColor" :layout-name="layoutName" :link-button="linkButton" :class="btnClass" />
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
        layoutName: {
            type: String,
            required: true,
        },
        linkButton: {
            type: Object,
            required: true,
        },
        textColor: {
            type: String,
        },
        isDemo: {
            type: Boolean,
            required: true
        }
    },
    computed: {
        linkClass() {
            if (this.button.buttonName !== "") {
                return [this.$style[this.layoutName], this.$style[this.button.buttonName], this.$style["image-link"]];
            }
            return [this.$style[this.layoutName], this.$style["image-link"]];
        },
        linkItemComponent() {
            let linkType = this.linkItem.linkType;
            if (linkType !== linkTypeEnum.title) {
                linkType = linkTypeEnum.normal;
            }

            linkType = linkType.toLowerCase();
            let LinkType = linkType.charAt(0).toUpperCase() + linkType.slice(1);

            return () => import(`./LinkItem${LinkType}`);
        },
        btnClass() {

            if(this.linkItem.linkType === linkTypeEnum.title) {
                return {}
            }

            if(this.linkItem.linkImgMode === 'BIG') {
                return {
                    [this.$style["link-animation"]]: true,
                    [this.$style[this.linkItem.linkCustomData.linkAnimation]]: this.linkItem.linkCustomData.linkAnimation !== "",
                    [this.$style["btn-big-image"]]: true,
                }

            }

            return {
                [this.$style["link-animation"]]: true,
                [this.$style[this.linkItem.linkCustomData.linkAnimation]]: this.linkItem.linkCustomData.linkAnimation !== "",
                [this.$style["btn"]]: true,
                [this.$style["btn-wz-image"]]: this.linkItem.thumbnail !== null && this.linkItem.thumbnail !== '',
            };

        },
    },
    methods: {
        linkClick($event) {

            $event.preventDefault();
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

            if(this.linkItem.linkPwd !== null && this.linkItem.linkPwd !== '') {
                
                this.$emit("open-pwd-form", {
                    linkId: this.linkItem.id,
                });
                return
            }

            let mediaOpenType = this.linkItem.mediaOpenType;
            let linkType = this.linkItem.linkType;

            if(linkType === linkTypeEnum.title) {
                return;
            } 

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
    },
};
</script>
<style lang="scss" module>
@import "../LinkItemCustom.scss";
.btn {
    // border: 1px solid rgba(#333, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px 10px;
    width: 100%;
    transition: 0.2s;
    border-radius: 5px;
    min-height: 35px;
    font-size: 16px;
    // word-break: break-all;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 8px 0px;
    text-align: center;
    &:hover {
        transform: translateY(3px);
    }
}

.btn-wz-image {
    padding: 15px 40px;
}

.btn-big-image {
    display: inline-block;
    width: 100%;
    transition: 0.2s;
    border-radius: 5px;
    min-height: 35px;
    font-size: 17px;
    word-break: break-all;
    text-align: center;
    box-shadow: rgba(0, 0, 0, 0.2) 0px 2px 8px 0px;
    &:hover {
        transform: translateY(3px);
    }
}
</style>
