<template>
  <div class="bottom_black">
    <div class="btn1"></div>
    <div class="btn2"></div>
    <div class="btn3"></div>
    <div class="btn4"></div>
    <div class="bottom_grey"></div>
    <div class="bottom_black2">
      <div class="bottom_black3"></div>
    </div>
    <div class="screen_bottom"></div>
    <div class="screen">
      <div class="main-display">
        <slot name="screen"></slot>
      </div>
    </div>
    <div v-if="cameraOn" class="camera">
      <div class="speaker"></div>
      <div class="lens">
        <div class="dot"></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    cameraOn: {
      type: Boolean,
      required: true,
      default: false
    }
  }
};
</script>

<style lang="sass" scoped>
@mixin ab_center
  position: absolute
  left: 50%
  top: 50%
  transform: translate(-50%, -50%)

.main-display
  height: 100%
  // overflow-y: scroll
  > div
    height: 100%
    width: 100%

.bottom_black
  width: 300px
  height: 600px
  background: #393939
  border-radius: 38px
  position: relative
  .btn1
    position: absolute
    width: 2px
    height: 22px
    top: 15%
    left: -3px
    background: #dfdfdf
    border: 2px solid rgba(#393939, 0.9)
    border-left: 1px solid rgba(#393939, 0.9)
    border-radius: 5px 0 0 5px
  .btn2
    position: absolute
    width: 2px
    height: 45px
    top: 22%
    left: -3px
    background: #dfdfdf
    border: 2px solid rgba(#393939, 0.9)
    border-left: 1px solid rgba(#393939, 0.9)
    border-radius: 5px 0 0 5px
  .btn3
    position: absolute
    width: 2px
    height: 42px
    top: 32%
    left: -3px
    background: #dfdfdf
    border: 2px solid rgba(#393939, 0.9)
    border-left: 1px solid rgba(#393939, 0.9)
    border-radius: 5px 0 0 5px
  .btn4
    position: absolute
    width: 2px
    height: 65px
    top: 25%
    right: -3px
    background: #dfdfdf
    border: 2px solid rgba(#393939, 0.9)
    border-right: 1px solid rgba(#393939, 0.9)
    border-radius: 0 5px 5px 0
  .bottom_grey
    filter: blur(1px)
    position: absolute
    width: 296px
    height: 595px
    background: #dfdfdf
    border-radius: 38px
    +ab_center
    &:before
      display: block
      content: ''
      position: absolute
      width: 296px
      height: 4px
      background: #000
      top: 12%
      filter: blur(0px)
    &:after
      display: block
      content: ''
      position: absolute
      width: 296px
      height: 4px
      background: #000
      top: 88%
      filter: blur(0px)
      
  .bottom_black2
    position: absolute
    width: 284px
    height: 582px
    background: #bdbdbd
    border-radius: 38px
    border: 3px solid #000b05
    filter: blur(1px)
    +ab_center
    .bottom_black3
      position: absolute
      width: 276px
      height: 586px
      background: #5f5f5f
      border-radius: 38px
      filter: blur(1px)
      //border: 3px solid #393939
      +ab_center
  .screen_bottom
    filter: blur(1px)
    position: absolute
    width: 272px
    height: 574px
    background: black
    border-radius: 38px
    //border: 8px solid black
    +ab_center
  .screen
    width: 264px
    height: 562px
    background: black
    border-radius: 38px
    //background-image: url(https://wallpapercanyon.com/wp-content/uploads/2017/09/iPhone-X-8-wallpaper-stock.png)
    background-size: 120%
    +ab_center
    background-color: white
    overflow: hidden
    
  .camera
    position: absolute
    text-outline: 50px
    left: 50%
    top: 18px
    transform: translateX(-50%)
    width: 140px
    height: 25px
    background: black
    border-radius: 0 0 18px 18px
    .speaker
      position: absolute
      text-outline: 50px
      left: 50%
      top: 7px
      transform: translateX(-50%)
      width: 40px
      height: 4px
      background: rgba(#262626, 0.6)
      border-radius: 50px
    .lens
      position: absolute
      text-outline: 50px
      left: 75%
      top: 5px
      transform: translateX(-50%)
      width: 8px
      height: 8px
      background: #01193b
      border-radius: 50px
      .dot
        position: absolute
        text-outline: 50px
        left: 40%
        top: 2px
        transform: translateX(-50%)
        width: 3px
        height: 3px
        background: #374b64
        border-radius: 50px
        filter: blur(1px)
</style>
