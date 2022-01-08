<template>
    <div>
        <div :class="[$style.wrapper, $style['wrapper::-webkit-scrollbar'], $style['container']]">
            <layout-background v-if="!customData.background.customBgOn" :layout-name="layoutName" :is-demo="isDemo"/>
            <custom-background :background="customData.background" :is-demo="isDemo"/>
            <avatar :avatar="avatar" :is-demo="isDemo" />
            <user-title :user-title="userTitle" :layout-name="layoutName" :text-color="customData.text.textColor" :is-demo="isDemo" />
            <description :description="description" :layout-name="layoutName" :text-color="customData.text.textColor" :is-demo="isDemo" />

            <link-items-main 
                :link-items="linkItemsMain" 
                :layout-name="layoutName" 
                :is-demo="isDemo" 
                :text-color="customData.text.textColor" 
                :button-bg-color="customData.linkButton.buttonBgColor"
                :button-text-color="customData.linkButton.buttonTextColor"
                @open-media-window="setMedia" 
                @open-pwd-form="setPwdData" 
            />

            <link-items :link-items="linkItems" :layout-name="layoutName" :is-demo="isDemo" :text-color="customData.text.textColor" :link-button="customData.linkButton" @open-media-window="setMedia" @open-pwd-form="setPwdData" />

            <social-links :social-links="linkItemsSocial" :is-demo="isDemo" :text-color="customData.text.textColor" />

            <support :text-color="customData.text.textColor" :display="customData.support.display" />
        </div>

        <media-window :link="mediaData.link" :media-name="mediaData.mediaName" @close-media="clearMedia" :is-demo="isDemo" />

        <pwd-form :link-items="linkItems" :link-items-main="linkItemsMain" :link-id="pwdData.linkId" @close-pwd-form="clearPwdData" :is-demo="isDemo" />

        <collector-form :link-id="collector.linkId" :collect-title="collector.collectTitle" :collect-rsp="collector.collectRsp" :collect-type="collector.collectType" @close-form="clearCollector" />
    </div>
</template>

<script>
import avatar from "./parts/Avatar";
import UserTitle from "./parts/UserTitle";
import Description from "./parts/Description";
import LinkItemsMain from "./parts/linkItems/LinkItemsMain";
import LinkItems from "./parts/linkItems/LinkItems";
import SocialLinks from "./parts/socialLinks/SocialLinks";
import LayoutBackground from "./background/LayoutBackground"
import Background from "./background/Background";
import Support from "./parts/Support";
import MediaWindow from "./parts/MediaWindow";
import CollectorForm from "./parts/CollectorForm";
import PwdForm from "./parts/PwdForm";

import { layoutClassMapping } from "./ClassMapping";
import trackApi from '../../../api/track/TrackApi'
import { isProd } from '../../../helper/env'
import { linkEvent, modelName } from "../../../enum/vo/LinkItemEnum";

export default {
    components: {
        avatar,
        customBackground: Background,
        LayoutBackground,
        UserTitle,
        Description,
        LinkItemsMain,
        LinkItems,
        SocialLinks,
        Support,
        MediaWindow,
        CollectorForm,
        PwdForm
    },
    props: {
        themeContent: {
            type: Object,
            required: true,
        },
        isDemo: {
            type: Boolean,
            default: false,
        },
    },
    data() {
        return {
            themeName: "Vbasic",
            layoutClassMapping,
            myIframe: "",
            mediaWindowOpen: false,
            mediaData: {
                link: "",
                mediaName: "",
            },
            collector: {
                linkId: "",
                collectType: "",
                collectTitle: "",
                collectRsp: "",
            },
            pwdData: {
                linkId: '',
            },
        };
    },
    computed: {
        layoutName() {
            return ''
            // return this.layoutClassMapping[this.themeContent.LYT.layoutClass];
        },
        avatar() {
            return this.themeContent.AVA;
        },
        userTitle() {
            return this.themeContent.UST;
        },
        description() {
            return this.themeContent.DESC;
        },
        linkItems() {
            return this.themeContent.LIL;
        },
        linkItemsMain() {
            return this.themeContent.LILM;
        },
        linkItemsSocial() {
            return this.themeContent.LILS;
        },
        socialLinks() {
            return this.themeContent.SOL;
        },
        customData() {
            return this.themeContent.CUSD.customData;
        },
    },
    methods: {
        clearMedia() {
            this.mediaData.link = "";
            this.mediaData.mediaName = "";
        },
        clearPwdData() {
            this.pwdData.linkId = "";
        },
        setMedia({ link, mediaName }) {
            // console.log(link, mediaName)
            this.mediaData.link = link;
            this.mediaData.mediaName = mediaName;
        },
        setPwdData({linkId}) {
            this.pwdData.linkId = linkId;
        },
        clearCollector() {
            this.collector.linkId = "";
            this.collector.collectType = "";
            this.collector.collectTitle = "";
            this.collector.collectRsp = "";
        },
        setCollector({ linkId, collectType, collectTitle, collectRsp }) {
            this.collector.linkId = linkId;
            this.collector.collectType = collectType;
            this.collector.collectTitle = collectTitle;
            this.collector.collectRsp = collectRsp;
        },
    },
    async mounted() {

        if(!this.isDemo) {

            try {

                await trackApi.eventCreate({
                    model_id: isProd() ? window.pid : this.$store.state.pageId,
                    model_parent_id: isProd() ? window.pid : this.$store.state.pageId,
                    model_name: modelName.vPage,
                    event_type: linkEvent.pageView,
                    vd: window.vd
                })
                
            } catch (error) {

                console.log(error)
            }
        }
    }
};
</script>
<style lang="scss">
.layout-background {
    background-position: center center;
    background-size: cover;
    background-repeat: no-repeat;
    z-index: -1;
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}

</style>

<style lang="scss">
.media-modal {
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(#000, 0.5);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: 0.3s;
    display: flex;
    justify-content: center;
    align-items: center;
    .window-wrapper {
        width: 100%;
        max-width: 450px;
        padding: 0 5px;
    }
    .window {
        position: relative;
        width: 100%;
        padding-bottom: 60%;
        iframe {
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            transform: translate(-50%, -50%);
            position: absolute;
        }
    }
}
</style>
<style lang="scss" module>
.bg {
    position: relative;
}

.wrapper {
    overflow-y: scroll;
    height: 100%;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}

.wrapper::-webkit-scrollbar {
    display: none;
}


.bg-none {
    background: none;
    background-image: none !important;
}

.container {
    max-width: 450px;
    margin: 0 auto;
}
</style>
