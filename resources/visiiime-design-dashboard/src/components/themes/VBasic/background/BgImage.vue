<template>
  <div class="bgImage" :style="{ backgroundImage: 'url(' + this.background.bgImage + ')' }"></div>
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
  left: 50%;
  transform: translateX(-50%);
  width: 100%;
  height: 100%;
  z-index: -1;
  background-position: center center;
  background-size: cover;
  max-width: 768px;

}
</style>
