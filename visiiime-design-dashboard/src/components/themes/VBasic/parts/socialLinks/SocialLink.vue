<template>
  <div class="social-link">
    <a :href="url" target="_blank">
      <fai :icon="[socialLink.fa, socialLink.icon]" size="lg" />
    </a>
  </div>
</template>

<script>
export default {
  props: {
    socialLink: {
      type: Object,
      required: true,
    }
  },
  computed: {
    url() {
      let url = '';
      switch (this.socialLink.icon) {
        case 'envelope':
          url = `mailto:${this.socialLink.link}`
          break;
        default:
          url = this.socialLink.link;
          break;
      }
      return url;
    }
  }
}

</script>
<style scoped>
.social-link {
  margin: 8px;
}
</style>