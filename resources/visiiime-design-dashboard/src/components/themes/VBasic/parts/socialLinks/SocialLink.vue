<template>
    <div class="social-link">
        <a :href="url" target="_blank">
            <vs-icon :icon-name="`${socialLink.fa}-${socialLink.icon}`" :size="'xl'"/>
        </a>
    </div>
</template>

<script>
import VsIcon from "../../../../../components/icon/VsIcon.vue";
export default {
    props: {
        linkItem: {
            type: Object,
            required: true,
        }
    },
    components: {
        VsIcon,
    },
    computed: {
        socialLink() {

            let linkNameArr = this.linkItem.linkName.split('-');

            return {
                fa: linkNameArr[0],
                icon: linkNameArr[1],
            }
        },
        url() {
            let url = "";
            switch (this.socialLink.icon) {
                case "envelope":
                    url = `mailto:${this.linkItem.link}`;
                    break;
                default:
                    url = this.linkItem.link;
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
