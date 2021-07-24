<template>
  <div :class="[$style['main-links'], $style[layoutName], isDemo?$style['demo']:'']">
    <link-item-main
      v-for="(item, idx) in linkItems.list" :key="idx"
      :link-item="item"
      :style="linkStyle"
    />

  </div>
</template>

<script>
import linkItemMain from "./linkItemMain/LinkItemMain";
export default {
  props: {
    linkItems: {
      type: Object,
      required: true,
    },
    layoutName: {
      type: String,
      required: true,
    },
    isDemo: {
      type: Boolean,
      default: false
    },
    textColor: {
        type: String
    }
  },
  components: {
    linkItemMain,
  },
    computed: {
        linkStyle() {
            if(this.textColor === '') {
                return {}
            }

            return {
                color: this.textColor
            }
        }
    },
  mounted() {},
};
</script>
<style lang="scss" module>
@import './LinkItemCustom.scss';
@import '../../layout/linksMain';
.main-links {
  display: flex;
  width: 90%;
  justify-content: center;
  margin: 0 auto;
  margin-bottom: 30px;
  div {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 0 10px;
  }
  a {
    display: inline-block;
    width: 65px;
    height: 65px;
    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
    }
  }
}
.demo {
  font-size: 14px;
  a {
    width: 60px;
    height: 60px;
  }
}
</style>
