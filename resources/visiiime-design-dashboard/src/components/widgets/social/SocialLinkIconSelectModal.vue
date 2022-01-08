<template>
    <modal
        name="SocialLinkIconSelectModal"
        :max-width="600" width="90%" height="auto" :adaptive="true"
        @before-open="beforeOpen"
    >
        <div class="max-h-96 overflow-y-scroll">
            <div class="mx-auto bg-white rounded-lg overflow-hidden">
                <div class="p-5">
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div v-for="(iconName, idx) in brandIconsSvg" :key="idx">
                            <div @click="addSocialLink(iconName)" class="border rounded p-2 cursor-pointer">
                                <div class="text-3xl text-center">
                                    <vs-icon 
                                        :icon-name="iconName" 
                                        class="flex justify-center items-center"
                                        :svg-size="40"
                                        :style="{margin: '0 auto'}"
                                     />
                                </div>
                                <div class="text-xs text-center">
                                    {{ iconDisplayName(iconName) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>
import LinkItemListVO from "@/vo/design/linkItemList/LinkItemListVO";
import svgIcons from "./SocialLinkIconsSvg";
import VsIcon from "../../icon/VsIcon.vue";

export default {
    data() {
        return {
            brandIconsSvg: svgIcons,
            idx: {
                type: Number,
                required: true
            }
        }
    },
    components: {
        VsIcon,
    },
    props: {
        linkItemListSocial: {
            type: LinkItemListVO,
            required: true
        }
    },
    methods: {
        addSocialLink(iconName) {
            this.linkItemListSocial.list[this.idx].linkName = iconName;

            this.$modal.hide('SocialLinkIconSelectModal')
        },
        iconDisplayName(iconName) {

            let iconNameStr = iconName;
            let iconNameArr = iconNameStr.split('-');
            let newIconName = '';

            iconNameArr.forEach((item, idx) => {
                if(idx !== 0) {
                    newIconName += `${item} `;
                }
            });

            return newIconName;

        },
        beforeOpen({ params }) {
            this.idx = params.idx;
        }
    },
}
</script>
