<template>
  <div class="Vbasic">
    <a @click.prevent :class="btnClass">
      {{ text }}
    </a>
  </div>
</template>

<script>

import { buttonClassMapping } from  '@/components/themes/VBasic/ClassMapping'
export default {
  props: {
    text: {
      type: String,
      required: true
    },
    buttonName: {
      type: String,
      required: true
    }
  },
  computed: {
    btnClass() {
      return buttonClassMapping[this.buttonName];
    }
  }
};
</script>
<style lang="scss" scoped>
@import '@/components/themes/VBasic/layout/customLink/index.scss';

a {
  // margin: 0 20px;
  border: 1px solid #333;
  color: #fff;
  background-color: #333;
  display: inline-block;
  padding: 10px;
  width: 80%;
  text-align: center;
}
</style>
