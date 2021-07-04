<template>
  <div class="bgImage" :style="{ backgroundImage: 'url(' + this.background.bgContent + ')' }"></div>
</template>


<script>
export default {
  props: {
    background: {
      type: Object,
      required: true,
    }
  }
};
</script>

<style lang="scss" scoped>
.bgImage {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  // inset: 0px;
  z-index: -1;
  background-position: center center;
  background-size: cover;
}
</style>