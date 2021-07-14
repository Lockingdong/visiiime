<template>
  <div :class="layoutClass">
    <div :class="$style.wrapper">
      <background :background="customData.background" />
      <avatar
        :avatar="avatar"
        :is-demo="isDemo"
      />
      <user-title
        :user-title="userTitle"
        :layout-name="layoutName"
        :text-color="customData.text.textColor"
        :is-demo="isDemo"
      />
      <description
        :description="description"
        :layout-name="layoutName"
        :text-color="customData.text.textColor"
        :is-demo="isDemo"
      />

      <link-items-main
        :link-items="linkItemsMain"
        :layout-name="layoutName"
        :is-demo="isDemo"
      />

      <link-items
        :link-items="linkItems"
        :layout-name="layoutName"
        :button-name="customData.button.buttonName"
        @open-media-window="setMedia"
        @open-collector-form="setCollector"
      />
      <social-links
        :social-links="socialLinks"
        :text-color="customData.text.textColor"
      />
    </div>

    <media-window
      :link="mediaData.link"
      :media-name="mediaData.mediaName"
      @close-media="clearMedia"
    />

    <collector-form
      :link-id="collector.linkId"
      :collect-title="collector.collectTitle"
      :collect-rsp="collector.collectRsp"
      :collect-type="collector.collectType"
      @close-form="clearCollector"
    />
  </div>
</template>

<script>

import avatar from './parts/Avatar'
import UserTitle from './parts/UserTitle'
import Description from './parts/Description'
import LinkItemsMain from './parts/linkItems/LinkItemsMain'
import LinkItems from './parts/linkItems/LinkItems'
import SocialLinks from './parts/socialLinks/SocialLinks'
import Background from './background/Background'
import MediaWindow from './parts/MediaWindow'
import CollectorForm from './parts/CollectorForm'

import { layoutClassMapping } from  './ClassMapping'
import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusCircle } from '@fortawesome/free-solid-svg-icons'
import { faEnvelope } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'

library.add(faPlusCircle, faEnvelope, fab)

export default {
  components: {
    avatar,
    Background,
    UserTitle,
    Description,
    LinkItemsMain,
    LinkItems,
    SocialLinks,
    MediaWindow,
    CollectorForm
  },
  props: {
    themeContent: {
      type: Object,
      required: true,
    },
    isDemo: {
      type: Boolean,
      default: false
    }
  },
  data() {
    return {
      themeName: 'Vbasic',
      layoutClassMapping,
      myIframe: '',
      mediaWindowOpen: false,
      mediaData: {
        link: '',
        mediaName: ''
      },
      collector: {
        linkId: '',
        collectType: '',
        collectTitle: '',
        collectRsp: ''
      }
    }
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
    layoutClass() {
      return [
        this.$style.bg,
        this.$style[this.layoutName],
        this.customData.background.customBgOn ? this.$style['bg-none']: ''
      ]
    },
  },
  methods: {
    clearMedia() {
      this.mediaData.link = '';
      this.mediaData.mediaName = '';
    },
    setMedia({link, mediaName}) {
      // console.log(link, mediaName)
      this.mediaData.link = link;
      this.mediaData.mediaName = mediaName;
    },
    clearCollector() {
      this.collector.linkId = '';
      this.collector.collectType = '';
      this.collector.collectTitle = '';
      this.collector.collectRsp = '';
    },
    setCollector({linkId, collectType, collectTitle, collectRsp}) {
      this.collector.linkId = linkId;
      this.collector.collectType = collectType;
      this.collector.collectTitle = collectTitle;
      this.collector.collectRsp = collectRsp;
    }
  },
  mounted() {
    // console.log(this.themeContent)
  }
};
</script>

<style lang="scss">
.media-modal {
  position: absolute;
  width: 100%;
  height: 100%;
  background: rgba(#000, 0.5);
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transition: .3s;
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
@import './layout/bg';
.bg {
  height: 100vh;
  overflow: hidden;
  position: relative;
}

.wrapper {
  overflow-y: scroll;
  height: 100%;
}

.bg-none {
  background: none;
}
</style>
