<template>
    <div class="mb-4">
        <div class="flex justify-center items-end">
            <div class="relative">
                <img @click="openUploadAvatarForm" class="w-28 h-28 rounded-full cursor-pointer" :src="avatarUrl" />
            </div>
        </div>
        <upload-image-modal :modal-name="modalName" :modal-title="'請上傳圖片'" :emit-function="'update-image'" @update-image="updateImage" />
    </div>
</template>

<script>
import uploadImageModal from "@/components/widgets/upload/UploadSingleImageModal";

import AvatarVO from "@/vo/design/profile/AvatarVO";
import { baseUrl } from "@/helper/env";
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";
// import { imageUpload } from "@/api/file/ImageUpload"

export default {
    props: {
        avatar: {
            type: AvatarVO,
            required: true,
        },
    },
    data() {
        return {
            modalName: "uploadAvatarForm",
        };
    },
    components: {
        uploadImageModal,
    },
    computed: {
        avatarUrl() {
            if(this.avatar.avatarUrl === null || this.avatar.avatarUrl === '') {
                return baseUrl() + '/VBasic/avatar-icon.png'
            }
            return this.avatar.avatarUrl;
        },
    },
    methods: {
        openUploadAvatarForm() {
            this.$modal.show(this.modalName);
        },
        updateImage(imgUrl) {
            this.avatar.avatarUrl = imgUrl;
            // vBasicPageApi.updatePageData({
            //     page_id: this.$store.state.pageId,
            //     field: 'avatar',
            //     data: imgUrl
            // }).then(rs => {
            //     this.avatar.avatarUrl = imgUrl;
            // }).catch(error => {
            //     console.log(error.response.data);
            //     alert('發生錯誤')
            // });
        },
    },
};
</script>

<style lang="scss"></style>
