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
      :emit-function="'update-image'"
      @update-image="updateImage"
    />
  </div>
</template>

<script>

import uploadImageModal from "@/components/widgets/upload/UploadSingleImageModal";

import AvatarVO from "@/vo/design/profile/AvatarVO";
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
      modalName: 'uploadAvatarForm'
    }
  },
  components: {
    uploadImageModal
  },
  computed: {
    avatarUrl() {
      return this.avatar.avatarUrl;
    },
  },
  methods: {
    openUploadAvatarForm() {
      this.$modal.show(this.modalName);
    },
    updateImage(imgUrl) {
      this.avatar.avatarUrl = imgUrl;
    }
  },
};
</script>

<style lang="scss">
</style>