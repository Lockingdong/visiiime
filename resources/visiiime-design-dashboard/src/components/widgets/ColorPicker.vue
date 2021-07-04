<template>
  <div>
    <v-swatches v-model="color"></v-swatches>
  </div>
</template>

<script>
import VSwatches from 'vue-swatches'
import 'vue-swatches/dist/vue-swatches.css'
export default {
  data() {
    return {
      color: "#ffffff"
    }
  },
  components: {
    VSwatches
  },
  props: {
    emitFunction: {
      type: String,
      required: true
    },
    myColor: {
      required: true
    }
  },
  watch: {
    color(nv, ov) {
      this.$emit(this.emitFunction, nv);
    }
  },
  created() {
    this.color = this.myColor;
  }
};
</script>

<style lang="scss" scoped>

</style>
