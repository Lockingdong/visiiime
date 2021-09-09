<template>
    <div :class="$style['avatar-wrapper']">
        <img :class="$style['avatar']" :src="avatar.avatarUrl" alt="" />
    </div>
</template>

<script>
export default {
    props: {
        avatar: {
            type: Object,
            required: true,
        },
        isDemo: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        avatarAreaClass() {
            if (this.isDemo) {
                return "avatar-area demo";
            }

            return "avatar-area";
        },
    },
};
</script>
<style lang="scss" module>

.avatar-wrapper {
    margin: 0 auto;
    width: 80px;
    height: 80px;
    position: relative;
    overflow: hidden;
    border-radius: 50%;
    margin-top: 66px;
}

.avatar {
    position: absolute;
    left: 50%;
    top: 50%;
    width: 100%;
    transform: translate(-50%, -50%);
}





// .avatar-area
//     text-align: center
//     padding-top: 66px
//     padding-bottom: 10px
//     .avatar

//     img
//         position: absolute
//         left: 50%
//         top: 50%
//         width: 100%
//         transform: translate(-50%, -50%)

// .avatar-area.demo
//     padding-top: 40px
//     padding-bottom: 15px
//     .avatar
//         width: 80px
//         height: 80px
</style>
