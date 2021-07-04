<template>
  <div>
    <a :href="linkItem.link" target="_blank" :class="linkClass">
      {{ linkItem.linkName }}
      <div :class="imageClass" :style="{ backgroundImage: 'url(' + linkItem.thumbnail + ')' }"></div>
    </a>
  </div>
</template>

<script>

import { buttonClassMapping } from  '../../../ClassMapping'

export default {
  data() {
    return {
      buttonClassMapping
    }
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
    buttonName: {
      type: String,
      default: "",
    },
  },
  computed: {
    linkClass() {
      if (this.buttonName !== "") {
        return [this.$style[this.layoutName], this.$style[this.buttonName], this.$style['image-link']];
      }
      return [this.$style[this.layoutName], this.$style['image-link']];
    },
    imageClass() {
      if(this.buttonName === buttonClassMapping.vRounded) {
        return [this.$style.image, this.$style[this.buttonName]];
      }
      return this.$style.image;
      
    }
  },
  mounted() {},
};
</script>
<style lang="sass" module>
@import '../../../layout/links'
@import '../../../layout/customLink'

.image-link
  position: relative

.image
  position: absolute
  width: 35px
  height: 35px
  left: 5px
  top: 50%
  transform: translateY(-50%)
  background-size: cover
  background-position: center center
</style>