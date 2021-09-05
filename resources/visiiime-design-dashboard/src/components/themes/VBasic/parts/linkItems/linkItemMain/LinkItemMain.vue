<template>
    <div>
        <a @click="linkClick" :href="linkItem.link" target="_blank" :class="animationClass">
            <img :src="linkItemThumbnail" />
        </a>
        <span :class="$style['title']">{{linkItem.linkName}}</span>
    </div>
</template>

<script>
import trackApi from '../../../../../../api/track/TrackApi'
export default {
    props: {
        linkItem: {
            type: Object,
            required: true,
        },
    },
    computed: {
        animationClass() {
            if (this.linkItem.linkCustomData.linkAnimation === "") {
                return this.$style["link-animation"];
            }
            return [this.$style["link-animation"], this.$style[this.linkItem.linkCustomData.linkAnimation]];
        },
        linkItemThumbnail() {
            if(this.linkItem.thumbnail.indexOf('cb-') !== -1) {
                return require(`../../../../../../assets/icons/png/color/brand/${this.linkItem.thumbnail}.png`)
            }
            return this.linkItem.thumbnail;
        }
    },
    methods: {
        linkClick() {
            if(!this.isDemo) {
                trackApi.eventCreate({
                    model_id: this.linkItem.id,
                    event_type: 'link_click',
                    v_data: window.vistorData
                }).then(() => {

                }).catch(e => {
                    console.log(e)
                })
            }
        }
    },
    mounted() {},
};
</script>
<style lang="sass" module>
@import '../LinkItemCustom'
@import '../../../layout/linksMain'
@import '../../../layout/customLink'

.title
    margin-top: 8px
    font-size: 16px
    color: inherit
</style>
