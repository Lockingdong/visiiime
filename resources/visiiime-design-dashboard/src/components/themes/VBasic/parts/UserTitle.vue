<template>
  <div :class="[isDemo?$style['title-area-demo']:$style['title-area']]">
    <div :class="[$style[layoutName], $style['user-title']]" :style="{color: getTextColor}">{{ userTitle.title }}</div>
  </div>
</template>

<script>
export default {
  props: {
    userTitle: {
      type: Object,
      required: true,
    },
    layoutName: {
      type: String,
      required: true,
    },
    textColor: {
      type: String,
      required: true
    },
    isDemo: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    getTextColor() {
      if(this.textColor !== '' && this.textColor !== undefined) {
        return this.textColor;
      }

      return 'inherit'
    }
  },
};
</script>
<style lang="scss" module>
@import '../layout/userTitle';
.title-area {
  text-align: center;
  margin-bottom: 6px;
  .user-title {
    font-size: 19px;
  }
}
.title-area-demo {
  text-align: center;
  margin-bottom: 6px;
  .user-title {
    font-size: 18px;
  }
}
</style>
