<template>
  <div :class="$style['desc']" :style="{color: getTextColor}">
    <p :class="$style[layoutName]">{{description.text}}</p>
  </div>
</template>

<script>
export default {
  props: {
    description: {
      type: Object,
      required: true
    },
    layoutName: {
      type: String,
      required: true,
    },
    textColor: {
      type: String,
      required: true
    }
  },
  computed: {
    getTextColor() {
      if(this.textColor !== '' && this.textColor !== undefined) {
        return this.textColor;
      }
      return 'inherit'
    }
  }
};
</script>
<style lang="scss" module>
@import '../layout/description';
.desc {
  max-width: 250px;
  margin: 0 auto;
  margin-bottom: 25px;
  font-size: 15px;
  text-align: center;
}

</style>
