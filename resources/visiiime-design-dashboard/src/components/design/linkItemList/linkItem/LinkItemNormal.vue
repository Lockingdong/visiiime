<template>
    <v-ob ref="vob" tag="div" class="p-2">
        <div class="flex justify-center align-middle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            <v-p v-slot="{ errors }" rules="required" name="連結名稱" tag="div" class="w-full">
                <input v-model.lazy="linkItem.linkName" :disabled="linkItem.online" type="text" class="w-full text-xs p-2 focus:border-red-100 outline-none" autocomplete="off" placeholder="連結名稱" @blur="updateLinkName()" required />
                <div class="mb-5 w-full text-red-500 text-xs">{{ errors[0] }}</div>
            </v-p>
        </div>
        <div class="flex justify-center align-middle mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                <path
                    fill-rule="evenodd"
                    d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z"
                    clip-rule="evenodd"
                />
            </svg>
            <v-p v-slot="{ errors }" rules="required|url" name="網址" tag="div" class="w-full">
                <input
                    @blur="updateLink()"
                    v-model.lazy="linkItem.link"
                    :disabled="linkItem.online"
                    type="text"
                    class="mb-0 w-full text-xs p-2 focus:border-red-100 outline-none"
                    autocomplete="off"
                    placeholder="https://www.example.com"
                    required
                />
                <div class="w-full text-red-500 text-xs">{{ errors[0] }}</div>
            </v-p>
        </div>
    </v-ob>
</template>

<script>
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import { CAN_USE_LINK_ITEM_NORMAL } from "@/enum/permission/vBasic/VPermission";
import { ValidationProvider as VP } from "vee-validate";

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
    },
    methods: {
        async validate() {

            const rs = await this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_NORMAL);
            if(!rs) {
                // todo ...
                this.linkItem.online = false;
                return
            }

            const result = await this.$refs.vob.validate();
            if (!result) {
                this.linkItem.online = false;
                this.linkItem.valid = false;
            } else {
                this.linkItem.valid = true;
            }
        },
        updateLink() {
            this.validate()
            // this.$emit('link-item-update', {
            //     field: 'link',
            //     data: this.linkItem.link
            // })
        },
        updateLinkName() {
            this.validate()
            // this.$emit('link-item-update', {
            //     field: 'link_name',
            //     data: this.linkItem.linkName
            // })
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
        // console.log(this.linkItem)
    },
};
</script>

<style lang="scss" scoped></style>
