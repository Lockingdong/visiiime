<template>
    <div class="wrapper">
        <div class="bgImage" :style="{ backgroundImage: 'url(' + this.background.bgImage + ')' }">
        </div>
        <div class="bgImageMain" :style="{ backgroundImage: 'url(' + this.background.bgImage + ')' }">
        </div>
    </div>
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
.wrapper {
overflow: hidden;

}

.bgImage {
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: -1;
  background-position: center center;
  background-size: cover;
  width: 110%;
height: 110%;
  position: absolute;
  filter: blur(10px) grayscale(30%);
  opacity: 0.9;

    // opacity: 0;
//   position: relative;
}

.bgImageMain {
    z-index: -1;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 100%;
    height: 100%;
    max-width: 768px;
    background-position: center center;
    background-size: cover;
    position: absolute;
}
</style>
