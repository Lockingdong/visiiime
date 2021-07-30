<template>
    <div class="phone-outter" :class="{ phoneBorder: outterFrame }">
        <div class="min-phone">
            <div v-if="backgroundColor === ''"
                :style="{ backgroundImage: 'url(' + previewImage + ')' }"
                class="main-display"
            ></div>
            <div
                v-else
                :style="{ backgroundColor: backgroundColor }"
                class="main-display"
            ></div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        previewImage: {
            type: String,
            required: true,
        },
        outterFrame: {
            type: Boolean,
            default: false,
        },
        backgroundColor: {
            type: String,
            default: ''
        }
    },
    mounted() {
        console.log(this.backgroundColor)
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

.main-display {
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
