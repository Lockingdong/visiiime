<template>
    <div v-if="mediaWindowOpen" @click.stop="closeWindow" class="media-modal">
        <div class="window-wrapper">
            <div class="window" v-html="iframe"></div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        link: {
            type: String,
            required: true,
        },
        mediaName: {
            type: String,
            required: true,
        },
    },
    computed: {
        mediaWindowOpen() {
            return this.link !== "" && this.mediaName !== "";
        },
        iframe() {
            let iframe = "";
            if (this.mediaName === "youtube") {
                const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/;
                const match = this.link.match(regExp);
                let youtubeId;
                if (match && match[2].length == 11) {
                    youtubeId = match[2];
                } else {
                    youtubeId = "error";
                }
                iframe = `<iframe src="//www.youtube.com/embed/${youtubeId}?autoplay=1" frameborder="0" allowfullscreen></iframe>`;
            } else if (this.mediaName === "spotify") {
                let iLink = this.link.replace("open.spotify.com", "open.spotify.com/embed");

                iframe = `<iframe src="${iLink}" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>`;
            } else if (this.mediaName === "appleP") {
                let ilink;
                if (this.link.indexOf("podcasts") !== -1) {
                    ilink = this.link.replace("podcasts", "embed.podcasts");
                }
                if (this.link.indexOf("itunes") !== -1) {
                    ilink = this.link.replace("itunes", "embed.itunes");
                }
                console.log(ilink);

                iframe = `<iframe src="${ilink}" frameborder="0" height="400" allowtransparency="true" allow="encrypted-media"></iframe>`;
            } else if (this.mediaName === "soundCld") {
                let iLink = this.link.replace("soundcloud.com/", "w.soundcloud.com/player/?url=https://soundcloud.com/");
                iframe = `<iframe src="${iLink}" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>`;
            }

            return iframe;
        },
    },
    methods: {
        closeWindow() {
            this.$emit("close-media");
        },
    },
};
</script>
<style lang="scss">
.media-modal {
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(#000, 0.5);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: 0.3s;
    display: flex;
    justify-content: center;
    align-items: center;
    .window-wrapper {
        width: 100%;
        max-width: 576px;
        padding: 0 5px;
    }
    .window {
        position: relative;
        width: 100%;
        padding-bottom: 60%;
        iframe {
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            transform: translate(-50%, -50%);
            position: absolute;
        }
    }
}
</style>
