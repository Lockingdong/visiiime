<template>
    <div class="p-2">
        <draggable :list="socialLinks.list" handle=".handle">
            <social-link v-for="(socialLink, idx) in socialLinks.list" :social-link="socialLink" :idx="idx" :key="idx" @remove-social-link="removeSocialLink" />
        </draggable>
        <div @click="openBrandSelect" class="flex items-center w-5/12 cursor-pointer">
            <div class="h-6 w-6 text-gray-700">
                <!-- <fai :icon="['fas', 'plus-circle']" size="lg" /> -->
                +
            </div>
            <div class="ml-3 border-gray-500 text-sm">
                Add New Social Media
            </div>
        </div>

        <modal name="brandSelect" :max-width="600" width="90%" height="auto" :adaptive="true">
            <div class="max-h-96 overflow-y-scroll">
                <div class="mx-auto bg-white rounded-lg overflow-hidden">
                    <div class="p-5">
                        <div class="w-full">
                            <div v-for="(iconName, idx) in brandIcons" :key="idx">
                                <div @click="addSocialLink(iconName)" class="flex border rounded p-3 mt-3 cursor-pointer">
                                    <div class="text-2xl">
                                        <vs-icon :icon-name="iconName" />
                                    </div>
                                    <div class="text-lg pl-3 flex items-center">
                                        {{ iconName }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </modal>
    </div>
</template>

<script>
import icons from "./icons";
import VsIcon from "../../icon/VsIcon.vue";

import SocialLink from "@/components/design/socialLinks/SocialLink";
import SocialLinkVO from "@/vo/design/socialLinks/SocialLinkVO";
import SocialLinksVO from "@/vo/design/socialLinks/SocialLinksVO";
import draggable from "vuedraggable";

import SocialLinksMixin from "@/mixins/VBasic/socialLinks/SocialLinksMixin";

export default {
    components: {
        SocialLink,
        draggable,
        VsIcon,
    },
    data() {
        return {
            icons,
            linkLimit: 10,
            brandIcons: icons
        };
    },
    mixins: [SocialLinksMixin],
    props: {
        socialLinks: {
            type: SocialLinksVO,
            required: true,
        },
    },
    methods: {
        openBrandSelect() {
            this.$modal.show("brandSelect");
        },
        addSocialLink(iconName) {

            let iconNameArr = iconName.split('-');
            let socialLink = new SocialLinkVO(iconNameArr[0], iconNameArr[1]);

            this.socialLinks.list.push(socialLink);
            this.$modal.hide("brandSelect");
        },
        removeSocialLink(idx) {
            this.socialLinksMixin_removeSocialLink(idx);
        },
    },
    created() {
        this.socialLinksMixin_list = this.socialLinks;
    },
    mounted() {
        // this.$modal.show('brandSelect')
    },
};
</script>
