<template>
  <div :class="[isDemo?$style['title-area-demo']:$style['title-area']]" :style="{color: getTextColor}">
    <h1 :class="$style[layoutName]">{{ userTitle.title }}</h1>
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
  margin-bottom: 15px;
}
.title-area-demo {
  margin-bottom: 10px;
}
h1 {
  font-size: 18px;
  text-align: center;
}
</style>