<template>
  <div class="bgImage" :style="bgGradient"></div>
</template>


<script>
export default {
  props: {
    background: {
      type: Object,
      required: true,
    }
  },
  computed: {
    bgGradient() {
        let color1 = (this.background.bgColor === '') ? '#ffffff' : this.background.bgColor;
        let color2 = (this.background.bgColor2 === '') ? '#ffffff' : this.background.bgColor2;
        return {
            background: `linear-gradient(to bottom, ${color1}, ${color2})` /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
    }
  }
};
</script>

<style lang="scss" scoped>
.bgImage {
  top: 0;
  left: 0;
  z-index: -1;
  background-position: center center;
  background-size: cover;
}
</style>
