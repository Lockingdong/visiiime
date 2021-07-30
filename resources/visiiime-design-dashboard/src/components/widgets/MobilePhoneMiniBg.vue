<template>
    <div class="phone-outter" :class="{ phoneBorder: outterFrame }">
        <div class="min-phone">

            <div v-if="backgroundObj.bgName === 'none' || backgroundObj.bgName === 'bgImage'"
                :style="{ backgroundImage: 'url(' + backgroundObj.previewImage + ')' }"
            >
            </div>
            <div
                v-if="backgroundObj.bgName === 'bgPlain'"
                :style="{ backgroundColor: backgroundObj.bgColor }"
            ></div>
            <div
                v-if="backgroundObj.bgName === 'bgGradient'"
                :style="bgGradient"
            ></div>

        </div>
    </div>
</template>

<script>
export default {
    props: {
        outterFrame: {
            type: Boolean,
            default: false,
        },
        backgroundObj: {
            type: Object
        }
    },
    computed: {
        bgGradient() {
            let color1 = (this.backgroundObj.bgColor === '') ? '#ffffff' : this.backgroundObj.bgColor;
            let color2 = (this.backgroundObj.bgColor2 === '') ? '#ffffff' : this.backgroundObj.bgColor2;
            return {
                background: `linear-gradient(to bottom, ${color1}, ${color2})` /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            }
        }
    },
    mounted() {
        // console.log(this.backgroundColor)
    }
};
</script>

<style lang="scss" scoped>


.min-phone {
    border: 5px solid #333;
    padding-bottom: 150%;
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}

.min-phone > div {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-position: center center;
    background-size: cover;
}

.phone-outter {
    border: 2px solid transparent;
    border-radius: 20px;
    padding: 2px;
}

.phoneBorder {
    border: 2px solid #999;
}
</style>
