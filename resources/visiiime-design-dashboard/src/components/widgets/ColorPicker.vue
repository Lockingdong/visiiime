<template>
  <div>
    <v-swatches
      v-model="color"
      popover-x="left"
      row-length="6"
      :swatches="swatches"
      :max-height="200"
      swatch-size="26"
      background-color="#333333"
    ></v-swatches>
  </div>
</template>

<script>
  import VSwatches from "vue-swatches";
  import "vue-swatches/dist/vue-swatches.css";
  export default {
    data() {
      return {
        color: "",
        swatches: [
          ["", "#000000", "#ffffff"],
          ["#fce4ec", "#f8bbd0", "#f06292", "#e91e63", "#c2185b", "#880e4f"],
          ["#e8eaf6", "#c5cae9", "#7986cb", "#3f51b5", "#303f9f", "#1a237e"],
          ["#e1f5fe", "#b3e5fc", "#4fc3f7", "#03a9f4", "#0288d1", "#01579b"],
          ["#e0f2f1", "#b2dfdb", "#4db6ac", "#009688", "#00796b", "#004d40"],
          ["#fffde7", "#fff9c4", "#fff176", "#ffeb3b", "#fbc02d", "#f57f17"],
          ["#fff3e0", "#ffe0b2", "#ffb74d", "#ff9800", "#f57c00", "#e65100"],
          ["#efebe9", "#d7ccc8", "#a1887f", "#795548", "#5d4037", "#3e2723"],
          ["#fafafa", "#f5f5f5", "#e0e0e0", "#9e9e9e", "#616161", "#212121"],
          ["#eceff1", "#cfd8dc", "#90a4ae", "#607d8b", "#455a64", "#263238"],
        ],
      };
    },
    components: {
      VSwatches,
    },
    props: {
      myColor: {
        required: true,
      },
    },
    watch: {
      color(nv, ov) {
        this.$emit("update-color", nv);
      },
    },
    created() {
      this.color = this.myColor;
    },
  };
</script>

<style lang="scss" scoped></style>
