<template>
    <div>
        <div :class="$style.wrapper">
            <!-- <div class="layout-background" :style="layoutBackGroundImage"></div> -->
            <layout-background v-if="!customData.background.customBgOn" :layout-name="layoutName" :is-demo="isDemo"/>
            <custom-background v-else :background="customData.background" :is-demo="isDemo"/>
            <avatar :avatar="avatar" :is-demo="isDemo" />
            <user-title :user-title="userTitle" :layout-name="layoutName" :text-color="customData.text.textColor" :is-demo="isDemo" />
            <description :description="description" :layout-name="layoutName" :text-color="customData.text.textColor" :is-demo="isDemo" />
            <link-items-main :link-items="linkItemsMain" :layout-name="layoutName" :is-demo="isDemo" :text-color="customData.text.textColor"/>
            <link-items :link-items="linkItems" :layout-name="layoutName" :link-button="customData.linkButton" @open-media-window="setMedia" @open-collector-form="setCollector" />
            <social-links :social-links="socialLinks" :text-color="customData.text.textColor" />
        </div>

        <media-window :link="mediaData.link" :media-name="mediaData.mediaName" @close-media="clearMedia" :is-demo="isDemo" />

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
import MediaWindow from "./parts/MediaWindow";
import CollectorForm from "./parts/CollectorForm";

import { layoutClassMapping } from "./ClassMapping";


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
        MediaWindow,
        CollectorForm,
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
        };
    },
    computed: {
        layoutName() {
            return this.layoutClassMapping[this.themeContent.LYT.layoutClass];
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
        setMedia({ link, mediaName }) {
            // console.log(link, mediaName)
            this.mediaData.link = link;
            this.mediaData.mediaName = mediaName;
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
    mounted() {
        console.log(this.customData)
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
        max-width: 576px;
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
}

.bg-none {
    background: none;
    background-image: none !important;
}
</style>
