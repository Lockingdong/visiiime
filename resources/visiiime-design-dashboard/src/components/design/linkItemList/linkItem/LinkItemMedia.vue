<template>
    <v-ob ref="vob" tag="div" class="p-2">
        <div class="mb-3 flex items-center text-gray-600">
            <fai :icon="['fa', 'photo-video']" class="fill-current mr-1" />

            <select class="select select-bordered select-sm flex-grow" v-model="linkItem.mediaName" :disabled="linkItem.online">
                <option value="youtube">Youtube</option>
                <option value="spotify">Spotify</option>
                <option value="appleP">Apple podcasts</option>
                <option value="soundCld">Sound Cloud</option>
            </select>
        </div>
        <div class="mb-3 flex justify-center align-middle">
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
                    @blur="validate" required class="input input-sm input-bordered">
                <div>
                    <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                </div>
            </v-p>
        </div>
        <div class="flex justify-center align-middle mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                <path
                    fill-rule="evenodd"
                    d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
                    clip-rule="evenodd"
                />
            </svg>
            <v-p v-slot="{ errors }" :rules="`required|${mediaRule}`" name="網址" tag="div" class="form-control w-full">
                <input
                    @blur="validate"
                    v-model="linkItem.link"
                    :class="{'input-error': errors.length !== 0}"
                    :disabled="linkItem.online"
                    type="text" class="input input-sm input-bordered" autocomplete="off" placeholder="https://www.example.com" required />
                <div>
                    <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                </div>
            </v-p>
        </div>
        <div class="">
            <label class="inline-flex items-center">
                <input v-model="linkItem.mediaOpenType" :disabled="linkItem.online" value="EXT" type="radio" class="form-radio radio-xs radio radio-primary" />
                <span class="ml-2">外部連結</span>
            </label>
            <label class="inline-flex items-center ml-6">
                <input v-model="linkItem.mediaOpenType" :disabled="linkItem.online" value="INR" type="radio" class="form-radio radio-xs radio radio-primary" />
                <span class="ml-2">內部開啟</span>
            </label>
        </div>
    </v-ob>
</template>

<script>
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import { ValidationProvider as VP } from "vee-validate";
import { CAN_USE_LINK_ITEM_MEDIA } from "@/enum/permission/vBasic/VPermission";

export default {
    components: {
        VP,
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
        mediaRule() {
            let rule = "";
            switch (this.linkItem.mediaName) {
                case "spotify":
                    rule = "spotifyUrl";
                    break;
                case "appleP":
                    rule = "applePUrl";
                    break;
                case "soundCld":
                    rule = "soundCldUrl";
                    break;
                default:
                    rule = "youtubeUrl";
                    break;
            }
            return rule;
        },
    },
    methods: {
        async validate() {

            const rs = await this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_MEDIA);
            if(!rs) {
                // todo ...
                this.linkItem.online = false;
                return
            }

            const result = await this.$refs.vob.validate();
            if (!result) {
                // post api
                this.linkItem.online = false;
                this.linkItem.valid = false;
            } else {
                this.linkItem.valid = true;
            }
        },
        updateImage(imageUrl) {
            this.linkItem.thumbnail = imageUrl;
        },
        openUploadImageForm() {
            this.$modal.show(this.modalName);
        },
    },
    watch: {
        "linkItem.online"() {
            this.validate();
        },
    },
    mounted() {
        this.validate();
    },
};
</script>

<style lang="scss" scoped></style>
