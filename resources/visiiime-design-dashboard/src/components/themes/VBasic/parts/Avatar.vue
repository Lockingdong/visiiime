<template>
  <div :class="avatarAreaClass">
    <div class="avatar">
      <img :src="avatar.avatarUrl" alt="">
    </div>
  </div>
</template>

<script>
export default {
  props: {
    avatar: {
      type: Object,
      required: true
    },
    isDemo: {
      type: Boolean,
      default: false
    }
  },
  computed: {
    avatarAreaClass() {
      if(this.isDemo) {
        return 'avatar-area demo';
      }

      return 'avatar-area';
    }
  }
};
</script>
<style lang="sass" scoped>
.avatar-area
  text-align: center
  padding-top: 66px
  padding-bottom: 10px
  .avatar
    position: relative
    width: 80px
    height: 80px
    margin: 0 auto
    overflow: hidden
    border-radius: 50%
    img
      position: absolute
      left: 50%
      top: 50%
      width: 100%
      transform: translate(-50%, -50%)

.avatar-area.demo
  padding-top: 40px
  padding-bottom: 15px
  .avatar
    width: 80px
    height: 80px
</style>
