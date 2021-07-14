<template>
  <div>
    <component
      @click.native="linkClick"
      :is="linkItemComponent"
      :link-item="linkItem"
      :layout-name="layoutName"
      :button-name="buttonName"
      :class="animationClass"
    />

  </div>
</template>


<script>
import { linkType as linkTypeEnum, mediaOpenType as mediaOpenTypeEnum } from '../../../../../../enum/vo/LinkItemEnum'
export default {
  props: {
    linkItem: {
      type: Object,
      required: true
    },
    layoutName: {
      type: String,
      required: true,
    },
    buttonName: {
      type: String,
      default: "",
    }
  },
  computed: {
    linkClass() {
      if (this.buttonName !== "") {
        return [this.$style[this.layoutName], this.$style[this.buttonName], this.$style['image-link']];
      }
      return [this.$style[this.layoutName], this.$style['image-link']];
    },
    linkItemComponent() {

      let linkType = this.linkItem.linkType;
      if(linkType !== linkTypeEnum.image) {
        linkType = linkTypeEnum.normal;
      }

      linkType = linkType.toLowerCase();
      let LinkType = linkType.charAt(0).toUpperCase() + linkType.slice(1)

      return () => import(`./LinkItem${LinkType}`);
    },
    animationClass() {
      if(this.linkItem.linkCustomData.linkAnimation === '') {
        return this.$style['link-animation'];
      }
      return [this.$style['link-animation'], this.$style[this.linkItem.linkCustomData.linkAnimation]];
    },

  },
  methods: {
    linkClick($event) {
      if(this.linkItem.mediaOpenType !== undefined
        && this.linkItem.mediaOpenType === mediaOpenTypeEnum.inr
        && this.linkItem.linkType === linkTypeEnum.media
      ) {
        $event.preventDefault();

        this.$emit('open-media-window', {
          link: this.linkItem.link,
          mediaName: this.linkItem.mediaName
        });

        return;
      } else if (this.linkItem.linkType === linkTypeEnum.collector) {
        this.$emit('open-collector-form', {
          linkId: this.linkItem.id,
          collectType: this.linkItem.collector.collectType,
          collectTitle: this.linkItem.collector.collectTitle,
          collectRsp: this.linkItem.collector.collectRsp
        });

        $event.preventDefault();
      }

    }
  },
  mounted() {
  }
};
</script>
<style lang="scss" module>
@import '../LinkItemCustom.scss';
</style>
