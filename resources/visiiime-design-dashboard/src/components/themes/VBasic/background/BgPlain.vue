<template>
  <div class="bgPlain" :style="{ backgroundColor: bgColor }"></div>
</template>


<script>
export default {
  props: {
    background: {
      type: Object,
    }
  },
  computed: {
    bgColor() {
      let background = this.background;
      if(background === undefined) {
        return '#ffffff'
      }
      return this.background.bgColor
    }
  }
};
</script>

<style lang="scss" scoped>
.bgPlain {
  // position: fixed;
  top: 0;
  left: 0;
  z-index: -1;
  background-position: center center;
  background-size: cover;
}
</style>
