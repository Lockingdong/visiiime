<template>
    <div class="social-link">
        <a :href="url" target="_blank">
            <vs-icon :icon-name="`${socialLink.fa}-${socialLink.icon}`" :size="'lg'"/>
        </a>
    </div>
</template>

<script>
import VsIcon from "../../../../../components/icon/VsIcon.vue";
export default {
    props: {
        socialLink: {
            type: Object,
            required: true,
        },
    },
    components: {
        VsIcon,
    },
    computed: {
        url() {
            let url = "";
            switch (this.socialLink.icon) {
                case "envelope":
                    url = `mailto:${this.socialLink.link}`;
                    break;
                default:
                    url = this.socialLink.link;
                    break;
            }
            return url;
        },
    },
};
</script>
<style scoped>
    .social-link {
        margin: 8px;
    }
</style>
