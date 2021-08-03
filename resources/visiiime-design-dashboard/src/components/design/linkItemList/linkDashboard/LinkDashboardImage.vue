<template>
    <div class="mb-3">
        <div class="text-center bg-gray-500 text-white py-1">add thumbnail</div>
        <div v-if="hasPermission" class="p-5">
            <template v-if="linkItem.thumbnail === '' || linkItem.thumbnail === null">
                <div class="flex text-center items-center justify-center">
                    <div @click="openUploadImageForm" class="px-8 py-3 bg-indigo-500 text-white rounded-lg cursor-pointer">add picture</div>
                </div>
            </template>
            <template v-else>
                <div class="flex">
                    <div class="flex-grow pr-3 text-center flex flex-col justify-around items-stretch">
                        <div @click="openUploadImageForm" class="px-8 py-2 bg-indigo-500 text-white rounded-lg cursor-pointer">replace</div>
                        <div @click="removeImage" class="px-8 py-2 bg-gray-400 text-white rounded-lg cursor-pointer">remove</div>
                    </div>
                    <div :style="{ backgroundImage: 'url(' + linkItem.thumbnail + ')' }" class="bg-cover bg-center w-28 h-28"></div>
                </div>
            </template>
        </div>
        <div v-else class="p-5">
            <!-- todo -->
            You don't have the permission.
        </div>
        <upload-image-modal :modal-name="modalName" :modal-title="'請上傳圖片'" :emit-function="'update-image'" @update-image="updateImage" />
    </div>
</template>

<script>
import uploadImageModal from "@/components/widgets/upload/UploadSingleImageModal";
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import { CAN_USE_LINK_ITEM_DBOARD_IMAGE } from "@/enum/permission/vBasic/VPermission";

export default {
    components: {
        uploadImageModal,
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
        hasPermission() {
            return this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_DBOARD_IMAGE);
        }
    },
    methods: {
        openUploadImageForm() {
            this.$modal.show(this.modalName);
        },
        updateImage(imageUrl) {
            // this.$emit('link-item-update', {
            //     field: 'thumbnail',
            //     data: imageUrl
            // })
            this.linkItem.thumbnail = imageUrl;
        },
        removeImage() {
            this.linkItem.thumbnail = "";
            // this.$emit('link-item-update', {
            //     field: 'thumbnail',
            //     data: ''
            // })
        },
    },
};
</script>

<style lang="scss" scoped></style>
