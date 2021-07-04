<template>
  <div class="mb-3">
    <div class="text-center bg-gray-500 text-white py-1">star</div>
    <div class="px-3 py-6 flex flex-wrap">
      <div :class="noneBtnClass" @click="setAnimation('')" class="rounded mr-2 border-2 px-4 py-2 text-center">none</div>
      <div :class="bounceBtnClass" @click="setAnimation('bounce')" class="rounded mr-2 border-2 px-4 py-2 text-center">bounce</div>
      <div :class="shakeBtnClass" @click="setAnimation('shake')" class="rounded mr-2 border-2 px-4 py-2 text-center">shake</div>
    </div>
  </div>
</template>
<script>
import LinkItemVO from '@/vo/design/linkItemList/LinkItemVO'

export default {
  data() {
    return {

    }
  },
  props: {
    linkItem: {
      type: LinkItemVO,
      required: true
    },
    idx: {
      type: Number,
      required: true
    }
  },
  computed: {
    linkAnimation() {
      return this.linkItem.linkCustomData.linkAnimation;
    },
    noneBtnClass() {
      return [this.$style["link-animation"]];
    },
    bounceBtnClass() {
      if(this.linkAnimation === 'bounce') {
        return [this.$style["link-animation"], this.$style["bounce"]];
      }
      return [this.$style["link-animation"]];
    },
    shakeBtnClass() {
      if(this.linkAnimation === 'shake') {
        return [this.$style["link-animation"], this.$style["shake"]];
      }
      return [this.$style["link-animation"]];
    }
  },
  methods: {
    setAnimation(className) {
      this.linkItem.linkCustomData.linkAnimation = className;
    }
  }
};
</script>

<style lang="scss" module>
@import '@/components/themes/VBasic/parts/linkItems/LinkItemCustom.scss';
</style>