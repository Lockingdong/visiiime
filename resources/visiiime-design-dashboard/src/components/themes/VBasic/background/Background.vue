<template>
  <div v-if="background.customBgOn">
    <component :is="bgName" :background="background" />
  </div>
</template>

<script>
import VBasicBackgroundVO from '../../../../vo/theme/customData/VBasic/VBasicBackgroundVO.js'
import BgPlain from './BgPlain.vue'
import Bg1 from './Bg1'
import Bg2 from './Bg2'
import Bg3 from './Bg3'
import Bg4 from './Bg4'

import BgImage from './BgImage';

export default {
  props: {
    background: {
      type: Object,
      required: true
    },
  },
  components: {
    bgPlain: BgPlain,
    bg1: Bg1,
    bg2: Bg2,
    bg3: Bg3,
    bg4: Bg4,
    bgImage: BgImage
  },
  data() {
    return {
      themeName: 'Vbasic'
    }
  },
  computed: {
    bgType() {
      return this.background.bgType;
    },
    bgName() {
      return this.background.bgName;
    },
    bgColor() {
      return this.background.bgColor;
    },
    content() {
      return this.background.bgContent;
    }
  }
};
</script>

<style lang="scss" scoped>
.background {
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
