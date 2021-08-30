<template>
    <div class="btn-group flex">
        <button class="btn btn-md btn-primary flex-grow border-r border-gray-100">新增連結</button>
        <button class="btn btn-md flex-none btn-primary border-l border-gray-100">
            <fai :icon="['fas', 'star']" size="lg" />
        </button>
    </div>
    <!-- <div class="flex">
        <button @click="addLinkItem(linkTypeEnum.normal, 'normal')" class="btn btn-primary w-full">新增連結</button>
        <v-button @click="featureButtonOn = !featureButtonOn" class="relative ml-2 w-30">
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
                <div @click="addLinkItem(linkTypeEnum.main, 'main')" tabindex="-1" class="outline-none block px-4 py-2 text-sm text-gray-700">主連結</div>
                <div @click="addLinkItem(linkTypeEnum.media, 'normal')" tabindex="-1" class="outline-none block px-4 py-2 text-sm text-gray-700">媒體連結</div>
                <div @click="addLinkItem(linkTypeEnum.collector, 'normal')" tabindex="-1" class="outline-none block px-4 py-2 text-sm text-gray-700">collector link</div>
            </div>
        </v-button>
    </div> -->
</template>
<script>
import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";
import { linkType as linkTypeEnum } from "@/enum/vo/LinkItemEnum";
import { confirmButtonColor, cancelButtonColor, confirmButtonText } from '@/helper/alertSetting'
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
    props: {
        linkLimit: {
            type: Object,
            required: true,
        },
        linkCount: {
            type: Object,
            required: true,
        }
    },
    methods: {
        addLinkItem(linkType, area) {

            if(this.linkCount[area] >= this.linkLimit[area]) {
                this.$swal({
                    confirmButtonColor,
                    cancelButtonColor,
                    confirmButtonText,
                    text: `連結限制為${this.linkLimit[area]}個`
                })
                return;
            }

            this.$emit("add-link-item", {
                linkType,
                id: ''
            });

        },
    },
};
</script>

<style lang="scss" scoped></style>
