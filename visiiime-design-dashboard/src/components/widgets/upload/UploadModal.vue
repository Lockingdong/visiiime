<template>
  <div>
    <modal
      name="uploadModal"
      :max-width="600"
      width="90%"
      height="auto"
      :adaptive="true"
    >
      <div>
        <div
          class="
            mx-auto
            bg-white
            rounded-2xl
            overflow-hidden
          "
        >
          <div class="md:flex">
            <div v-if="uploadType === ''" class="w-full">
              <div class="p-4 border-b-2">
                <span class="text-lg text-gray-600 font-normal">選擇背景</span>
              </div>
              <div @click="uploadType = 'uploadImage'" class="grid grid-cols-4 gap-2 p-2">
                <div class="col-span-1">
                  <div
                    class="h-16 w-16 bg-cover bg-center rounded-2xl"
                    style="background-image: url('https://placekitten.com/200/200');"
                  ></div>
                </div>
                <div class="col-span-3">
                  <div class="font-normal text-lg">上傳圖片</div>
                </div>
              </div>
              <!-- <div class="grid grid-cols-4 gap-2 p-2">
                <div class="col-span-1">
                  <div class="h-16 w-16 bg-cover bg-center rounded-2xl" style="background-image: url('https://placekitten.com/200/200')"></div>
                </div>
                <div class="col-span-3">
                  <div class="font-normal text-lg">Pick From Unsplash</div>
                </div>
              </div> -->
            </div>
            <div v-if="uploadType === 'uploadImage'" class="w-full">
              <div class="p-5 w-full">
                <div class="text-lg text-gray-600 font-normal border-b-2 mb-5">上傳圖片</div>
                <div class="w-full">
                  <div class="border-dashed border-gray-100 border-2 h-96 flex justify-center items-center">
                    <div v-show="fileUpload.previewImage === ''" class="w-full h-full">
                      <file-upload
                        ref="upload"
                        :drop="true"
                        v-model="fileUpload.files"
                        @input-file="inputFile"
                        @input-filter="inputFilter"
                      >
                      upload an photo or drag an image here
                      </file-upload>
                    </div>
                    <div v-show="fileUpload.previewImage !== ''" class="w-full h-full">
                      <img class="w-full h-full object-contain" :src="fileUpload.previewImage" alt="">
                      
                    </div>
                  </div>
                </div>
                <div v-show="fileUpload.previewImage !== ''" class="text-center mt-5">
                  <button
                    v-show="!$refs.upload || !$refs.upload.active"
                    @click.prevent="backgroundUpload"
                    type="button"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"
                  >
                    開始上傳
                  </button>
                </div>
              </div>

              
              <!-- <file-upload
                ref="upload"
                v-model="files"
                post-action="/post.method"
                put-action="/put.method"
                @input-file="inputFile"
                @input-filter="inputFilter"
              >
                上传文件
              </file-upload>
              
              <button
                v-show="$refs.upload && $refs.upload.active"
                @click.prevent="$refs.upload.active = false"
                type="button"
              >
                停止上传
              </button> -->
            </div>
          </div>
        </div>
      </div>
    </modal>
  </div>
</template>

<script>
import fileUpload from "vue-upload-component";
import { imageUpload } from "@/api/file/ImageUpload"

export default {
  components: {
    fileUpload,
  },
  data() {
    return {
      uploadType: "",
      fileUpload: {
        files: [],
        previewImage: ''
      }
    };
  },
  props: {
    emitFunction: {
      type: String
    }
  },
  methods: {
    /**
     * Has changed
     * @param  Object|undefined   newFile   只读
     * @param  Object|undefined   oldFile   只读
     * @return undefined
     */
    inputFile: function (newFile, oldFile) {
      if (newFile && oldFile && !newFile.active && oldFile.active) {
        // 获得相应数据
        // console.log('response', newFile.response)
        if (newFile.xhr) {
          //  获得响应状态码
          // console.log('status', newFile.xhr.status)
        }
      }
    },
    /**
     * Pretreatment
     * @param  Object|undefined   newFile   读写
     * @param  Object|undefined   oldFile   只读
     * @param  Function           prevent   阻止回调
     * @return undefined
     */
    inputFilter: function (newFile, oldFile, prevent) {
      if (newFile && !oldFile) {
        // 过滤不是图片后缀的文件
        if (!/\.(jpeg|jpe|jpg|gif|png|webp)$/i.test(newFile.name)) {
          return prevent()
        }
      }

      // 创建 blob 字段 用于图片预览
      newFile.blob = ''
      let URL = window.URL || window.webkitURL
      if (URL && URL.createObjectURL) {
        newFile.blob = URL.createObjectURL(newFile.file)
        this.fileUpload.previewImage = newFile.blob;
      }
    },
    backgroundUpload() {
      this.$refs.upload.active = true
      
      const formData = new FormData();
      formData.append("upload", this.fileUpload.files[0].file);
      imageUpload(formData).then(rs => {
        // this.avatar.avatarUrl = rs.url
        this.$emit(this.emitFunction, rs.url)
        this.reset()
      });
    },
    reset() {
      this.fileUpload.files = [];
      this.fileUpload.previewImage = "";
      this.uploadType = ""
    }
  }
};
</script>

<style lang="scss" scoped>
.file-uploads-html5 {
  width: 100%;
  height: 100%;
  display: inline-block;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
