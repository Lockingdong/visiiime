<template>
    <div class="mb-4">
        <div class="flex justify-center items-end">
            <div class="relative">
                <img @click="openUploadAvatarForm" class="w-28 h-28 rounded-full cursor-pointer" :src="avatarUrl" />
            </div>
        </div>
        <upload-image-modal
            :modal-name="modalName"
            :modal-title="'請上傳圖片'"
            :size="100"
            :model-id="$store.state.pageId"
            :model-name="'VPage'"
            :field-name="'avatar'"
            @update-image="updateImage"
        />
    </div>
</template>

<script>
import uploadImageModal from "@/components/widgets/upload/UploadSingleImageModal";

import AvatarVO from "@/vo/design/profile/AvatarVO";
import { baseUrl } from "@/helper/env";
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";

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
        async updateImage(imgUrl, result) {

            try {

                if(result === 'succ') {
                    await vBasicPageApi.updatePageData({
                        page_id: this.$store.state.pageId,
                        field: 'avatar',
                        data: imgUrl
                    })

                    this.avatar.avatarUrl = imgUrl;

                    this.$modal.show('result-modal', {
                        header: '更新成功',
                    })
                } else {
                    throw new Error('上傳圖片發生錯誤')
                }
                
            } catch (error) {

                console.log(error.response.data);

                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: '請重新上傳圖片'
                })

                this.$modal.show(this.resultModalData.name)
                
            }

        },
    },
};
</script>

<style lang="scss"></style>
