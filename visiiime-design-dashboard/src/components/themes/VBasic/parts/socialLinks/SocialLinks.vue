<template>
  <div :class="$style['social-links']">
    <social-link
      v-for="(item, idx) in socialLinks.list"
      :key="idx"
      :social-link="item"
      :style="{color: getTextColor}"
    />
  </div>
</template>
<script>
import SocialLink from './SocialLink'
export default {
  components: {
    SocialLink
  },
  props: {
    socialLinks: {
      type: Object,
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
.social-links {
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  max-width: 300px;
  margin: 0 auto;
  margin-bottom: 30px;
}
</style>