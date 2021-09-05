<template>
    <div class="mb-3">
        <div class="text-center bg-gray-500 text-white py-1">連結圖片</div>
        <div v-if="hasPermission" class="p-5">
            <template v-if="linkItem.thumbnail === '' || linkItem.thumbnail === null">
                <div class="flex text-center items-center justify-center">
                    <div @click="openUploadImageForm" class="btn btn-primary">上傳圖片</div>
                </div>
            </template>
            <template v-else>
                <div class="flex">
                    <div class="flex-grow pr-3 text-center flex flex-col justify-around items-stretch">
                        <div @click="openUploadImageForm" class="btn btn-primary">更換</div>
                        <div @click="removeImage" class="btn">移除</div>
                    </div>
                    <div class="avatar">
                        <div class="w-28 h-28">
                            <img :src="linkItemThumbnail" alt="">
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div v-else class="p-5">
            <!-- todo -->
            You don't have the permission.
        </div>
        <upload-image-modal
            :modal-name="modalName"
            :modal-title="'請上傳圖片'"
            :size="500"
            :model-id="$store.state.pageId"
            :model-name="'VPage'"
            :field-name="'linkItemImage'"
            @update-image="updateImage"
        />
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
            return "linkItem" + this.linkItem.id;
        },
        hasPermission() {
            return this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_DBOARD_IMAGE);
        },
        linkItemThumbnail() {
            if(this.linkItem.thumbnail.indexOf('cb-') !== -1) {
                return require(`@/assets/icons/png/color/brand/${this.linkItem.thumbnail}.png`)
            }
            return this.linkItem.thumbnail;
        }
    },
    methods: {
        openUploadImageForm() {
            this.$modal.show('ImageTypeSelectModal', {
                linkItemId: this.linkItem.id
            });
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
