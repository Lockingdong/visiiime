<template>
    <v-ob ref="vob" tag="div" class="p-1 pt-2">
        <!-- <span v-show="linkItem.mediaName !== null && linkItem.mediaName !== ''" class="badge badge-success text-xs mt-1 mr-1 mb-1">偵測為 {{linkItem.mediaName}} 連結</span> -->
        <div class="flex justify-center align-middle mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            <v-p v-slot="{ errors }" rules="required" name="連結名稱" tag="div" class="form-control w-full">
                <input
                    v-model="linkItem.linkName"
                    :disabled="linkItem.online"
                    :class="{'input-error': errors.length !== 0}"
                    type="text"
                    autocomplete="off"
                    placeholder="連結名稱"
                    class="input input-sm input-bordered w-full">
                <div>
                    <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                </div>
            </v-p>
        </div>
        <div class="flex justify-center align-middle mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                <path
                    fill-rule="evenodd"
                    d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
                    clip-rule="evenodd"
                />
            </svg>
            <v-p v-slot="{ errors }" rules="required|url" name="網址" tag="div" class="form-control w-full">
                <input
                    @blur="updateLink()"
                    v-model.lazy="linkItem.link"
                    :disabled="linkItem.online"
                    :class="{'input-error': errors.length !== 0}"
                    type="text"
                    class="input input-sm input-bordered w-full"
                    autocomplete="off"
                    placeholder="https://www.example.com"
                    required
                />
                <div>
                    <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                </div>
            </v-p>
        </div>
        <div v-if="linkItem.linkType === linkTypeEnum.media">
            <label class="inline-flex items-center">
                <input v-model="linkItem.mediaOpenType" :disabled="linkItem.online" value="EXT" type="radio" class="form-radio radio-xs radio radio-primary" />
                <span class="ml-2 text-xs">外部連結</span>
            </label>
            <label class="inline-flex items-center ml-6">
                <input v-model="linkItem.mediaOpenType" :disabled="linkItem.online" value="INR" type="radio" class="form-radio radio-xs radio radio-primary" />
                <span class="ml-2 text-xs">內嵌式開啟</span>
            </label>
        </div>
        <div v-else style="height: 24px;" class=" pl-6">
            <template v-if="linkItem.linkImgMode === 'BIG' ">
                <div class="badge badge-sm badge-primary">{{ 'LARGE' }}</div> 
            </template>
            <template v-if="linkItem.linkColMode === '50' ">
                <div class="badge badge-sm badge-primary">{{ 'SHORT' }}</div> 
            </template>
        </div>
    </v-ob>
</template>

<script>
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import { CAN_USE_LINK_ITEM_NORMAL } from "@/enum/permission/vBasic/VPermission";
import { ValidationProvider as VP } from "vee-validate";

import { getOembedByUrl } from "@/helper/urlEmbedParser";

import {
    linkType as linkTypeEnum,
    linkArea as linkAreaEnum,
    mediaOpenType as mediaOpenTypeEnum
} from "@/enum/vo/LinkItemEnum";


export default {
    components: {
        VP,
    },
    data() {
        return {
            linkTypeEnum,
            linkAreaEnum,
            mediaOpenTypeEnum,
            allowedMedia: ['YouTube', 'SoundCloud', 'Spotify']
        }
    },
    props: {
        linkItem: {
            type: LinkItemVO,
            required: true,
        },
        idx: {
            type: Number,
            required: true,
        },
    },
    computed: {
        modalName() {
            return "linkItem" + this.idx;
        },
    },
    methods: {
        async validate() {

            try {

                const rs = await this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_NORMAL);
                if(!rs) {
                    throw 'permission deny'
                }

                const result = await this.$refs.vob.validate();
                if(!result) {
                    throw 'validate error'
                }

                return true

            } catch (err) {

                console.log(err)

                return false
            }

        },
        async updateLink() {

            const rs = await getOembedByUrl(this.linkItem.link);

            if(rs === null || !this.allowedMedia.includes(rs.provider_name)) {
                this.linkItem.linkType = this.linkTypeEnum.normal;
                this.linkItem.mediaOpenType = mediaOpenTypeEnum.ext;
                this.linkItem.mediaName = null;
            } else {
                this.linkItem.linkType = this.linkTypeEnum.media;
                this.linkItem.mediaName = rs.provider_name;
            }

        },
        updateImage(imageUrl) {
            this.linkItem.thumbnail = imageUrl;
        },
    },
    watch: {
    },
    mounted() {
    },
};
</script>

<style lang="scss" scoped></style>
