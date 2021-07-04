<template>
  <div class="mb-3">
    <div class="text-center bg-gray-500 text-white py-1">add thumbnail</div>
    <div class="p-5">
      <template v-if="linkItem.thumbnail === ''">
        <div class="flex text-center items-center justify-center">
          <div
            @click="openUploadImageForm"
            class="px-8 py-3 bg-indigo-500 text-white rounded-lg cursor-pointer"
          >add picture</div>
        </div>
      </template>
      <template v-else>
        <div class="flex">
          <div class="flex-grow pr-3 text-center flex flex-col justify-around items-stretch">
            <div
              @click="openUploadImageForm"
              class="px-8 py-2 bg-indigo-500 text-white rounded-lg cursor-pointer"
            >replace</div>
            <div
              @click="removeImage"
              class="px-8 py-2 bg-gray-400 text-white rounded-lg cursor-pointer"
            >remove</div>
          </div>
          <div
            :style="{ backgroundImage: 'url(' + linkItem.thumbnail + ')' }"
            class="bg-cover bg-center w-28 h-28"
          ></div>
        </div>
      </template>
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
import LinkItemVO from '@/vo/design/linkItemList/LinkItemVO'

export default {
  components: {
    uploadImageModal,
  },
  props: {
    linkItem: {
      type: LinkItemVO,
      required: true
    },
    idx: {
      type: Number,
      required: true
    }
  },
  computed: {
    modalName() {
      return 'linkItem' + this.idx
    },
  },
  methods: {
    openUploadImageForm() {
      this.$modal.show(this.modalName);
    },
    updateImage(imageUrl) {
      this.linkItem.thumbnail = imageUrl
    },
    removeImage() {
      this.linkItem.thumbnail = "";
    },
  }


};
</script>

<style lang="scss" scoped>
</style>