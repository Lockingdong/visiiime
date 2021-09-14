<template>
    <v-ob ref="vob" tag="div" class="p-3">
        <div class="flex justify-center align-middle mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            <v-p v-slot="{ errors }" rules="required" name="標題名稱" tag="div" class="form-control w-full">
                <input
                    v-model="linkItem.linkName"
                    :disabled="linkItem.online"
                    :class="{'input-error': errors.length !== 0}"
                    type="text"
                    autocomplete="off"
                    placeholder="標題名稱"
                    class="input input-sm input-bordered">
                <div>
                    <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                </div>
            </v-p>
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
        online: {
            type: Boolean,
            required: true
        }
    },
    computed: {
        modalName() {
            return "linkItem" + this.idx;
        },
    },
    methods: {
        async validate() {

            const rs = await this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_NORMAL);
            if(!rs) {
                // todo ...
                this.linkItem.online = false;
                this.$emit('setParentOnline', false);
                return
            }

            const result = await this.$refs.vob.validate();
            if (!result) {
                this.linkItem.online = false;
                this.linkItem.valid = false;
                this.$emit('setParentOnline', false);
            } else {
                this.linkItem.valid = true;
                this.linkItem.online = true;
                this.$emit('setParentOnline', true);
            }
        },
        async updateLink() {

            const rs = await getOembedByUrl(this.linkItem.link);

            console.log(rs);

            if(rs === null || !this.allowedMedia.includes(rs.provider_name)) {
                this.linkItem.linkType = this.linkTypeEnum.normal;
                this.linkItem.mediaOpenType = mediaOpenTypeEnum.ext;
                this.linkItem.mediaName = null;
            } else {
                this.linkItem.linkType = this.linkTypeEnum.media;
                this.linkItem.mediaName = rs.provider_name;
                // this.linkItem.thumbnail = rs.thumbnail_url
            }

            // await this.validate();

        },
        updateImage(imageUrl) {
            this.linkItem.thumbnail = imageUrl;
        },
    },
    watch: {
        online(nv, ov) {
            if(nv) {
                this.validate();
            } else {
                this.linkItem.online = false;
            }
        },
    },
    mounted() {
        if(this.linkItem.online) {
            this.validate();
        }
    },
};
</script>

<style lang="scss" scoped></style>
