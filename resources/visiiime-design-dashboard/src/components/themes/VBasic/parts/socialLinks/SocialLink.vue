<template>
    <div @click="linkClick" class="social-link">
        <a :href="url" target="_blank">
            <vs-icon 
                :icon-name="`${socialLink.fa}-${socialLink.icon}`"
                :svg-size="42"
            />
        </a>
    </div>
</template>

<script>
import VsIcon from "../../../../../components/icon/VsIcon.vue";
import { linkType as linkTypeEnum, mediaOpenType as mediaOpenTypeEnum, linkEvent, modelName } from "../../../../../enum/vo/LinkItemEnum";
import trackApi from '../../../../../api/track/TrackApi'
import { isProd } from '../../../../../helper/env'
export default {
    props: {
        linkItem: {
            type: Object,
            required: true,
        },
        isDemo: {
            type: Boolean,
            default: false,
        },
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
                case "email":
                    url = `mailto:${this.linkItem.link}`;
                    break;
                default:
                    url = this.linkItem.link;
                    break;
            }
            return url;
        },
    },
    methods: {
        async linkClick() {

            try {
                if(!this.isDemo) {
                    await trackApi.eventCreate({
                        model_id: this.linkItem.id,
                        model_parent_id: isProd() ? window.pid : this.$store.state.pageId,
                        model_name: modelName.vlinkItemMain,
                        event_type: linkEvent.click,
                        vd: window.vd
                    })

                }
                
            } catch (error) {

                console.log(error)
                
            }

        }
    }
};
</script>
<style scoped>
    .social-link {
        margin: 8px;
    }
</style>
