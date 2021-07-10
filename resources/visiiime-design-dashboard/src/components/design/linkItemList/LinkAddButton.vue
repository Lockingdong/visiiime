<template>
    <div class="flex">
        <button class="w-full py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none" @click="addLinkItem(linkTypeEnum.normal)">ADD LINK</button>
        <button @click="featureButtonOn = !featureButtonOn" class="relative ml-2 w-30 py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-400 focus:outline-none">
            <fai :icon="['fas', 'star']" size="lg" />
            <div
                v-show="featureButtonOn"
                role="menu"
                aria-orientation="vertical"
                aria-labelledby="user-menu-button"
                tabindex="-1"
                class="z-10 origin-top-right absolute right-0 top-10 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none text-left"
                style=""
            >
                <div @click="addLinkItem(linkTypeEnum.main)" tabindex="-1" class="outline-none block px-4 py-2 text-sm text-gray-700">main link</div>
                <div @click="addLinkItem(linkTypeEnum.media)" tabindex="-1" class="outline-none block px-4 py-2 text-sm text-gray-700">media link</div>
                <div @click="addLinkItem(linkTypeEnum.collector)" tabindex="-1" class="outline-none block px-4 py-2 text-sm text-gray-700">collector link</div>
            </div>
        </button>
    </div>
</template>
<script>
import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";
import { linkType as linkTypeEnum } from "@/enum/vo/LinkItemEnum";

import { library } from "@fortawesome/fontawesome-svg-core";
import { faImage } from "@fortawesome/free-regular-svg-icons";
import { faStar } from "@fortawesome/free-solid-svg-icons";
library.add(faImage, faStar);
export default {
    data() {
        return {
            featureButtonOn: false,
            linkTypeEnum,
        };
    },
    methods: {
        addLinkItem(linkType) {

            vBasicLinkItemApi.linkItemCreate({
                page_id: this.$store.state.pageId,
                user_id: '',
                link_type: linkType
            }).then(rs => {
                this.$emit("add-link-item", {
                    linkType,
                    id: rs.data.id
                });
            }).catch(error => {
                console.log(error.response.data);
                alert('發生錯誤')
            });
        },
    },
};
</script>

<style lang="scss" scoped></style>
