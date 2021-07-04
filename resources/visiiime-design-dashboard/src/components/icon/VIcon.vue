<template>
  <component :is="component"></component>
</template>

<script>
export default {
  props: {
    icon: {
      type: String,
      required: true
    }
  },
  computed: {
    component() {
      let icon = this.icon.toLowerCase();
      const Icon = icon.charAt(0).toUpperCase() + icon.slice(1)
      return () => import(`./${Icon}`);
    }
  }
}
</script>