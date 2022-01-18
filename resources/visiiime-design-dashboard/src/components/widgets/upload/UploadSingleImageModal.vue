<template>
    <div>
        <modal :name="modalName" :max-width="600" width="90%" height="auto" :adaptive="true" @before-close="beforeClose">
            <div>
                <div class="mx-auto bg-white overflow-hidden relative">
                    <div v-if="step === 'step1'" class="flex">
                        
                        <div class="w-full">
                            <div class="p-4 border-b-2">
                                <span class="text-lg font-bold text-gray-600">{{ modalTitle }}</span>
                            </div>
                            <div class="py-5">
                                <div class="flex justify-center">
                                    <croppa
                                        v-model="croppa"
                                        class="border-dashed border-2 border-gray-200"
                                        canvas-color="transparent"
                                        :accept="croppaSetting.accept"
                                        :width="croppaSettingSize.width"
                                        :height="croppaSettingSize.height"
                                        :placeholder="croppaSetting.placeholder"
                                        :placeholder-color="croppaSetting.placeholderColor"
                                        :placeholder-font-size="croppaSetting.placeholderFontSize"
                                        :prevent-white-space="croppaSetting.preventWhiteSpace"
                                        :file-size-limit="croppaSetting.fileSizeLimit"
                                        @new-image-drawn="handleNewImage"
                                        @image-remove="handleImageRemove"
                                        @file-size-exceed="handleCroppaFileSizeExceed"
                                    />
                                </div>
                                <div v-show="errorMsg !== ''" class="pt-5 flex justify-center text-red-500">{{ errorMsg }}</div>
                                <div v-show="!showHandleArea" class="pt-5 flex-col align-middle text-center">
                                    <div class="text-gray-500 text-xs mb-3">限 jpg png jpeg</div>
                                    <button @click="closeUploadAvatarForm" class="h-12 text-sm w-32 bg-gray-300 rounded text-white">取消</button>
                                </div>
                                <div v-show="showHandleArea" class="mt-6 text-center pb-3 w-1/2 flex justify-between mx-auto">
                                    <template v-if="hasPermission">
                                        <svg @click="rotateCroppa" xmlns="http://www.w3.org/2000/svg" class="bottom-0 ml-2 h-5 6 text-gray-600 fill-current cursor-pointer" fill="currentColor" viewBox="0 0 512 512">
                                            <path
                                                fill="currentColor"
                                                d="M212.333 224.333H12c-6.627 0-12-5.373-12-12V12C0 5.373 5.373 0 12 0h48c6.627 0 12 5.373 12 12v78.112C117.773 39.279 184.26 7.47 258.175 8.007c136.906.994 246.448 111.623 246.157 248.532C504.041 393.258 393.12 504 256.333 504c-64.089 0-122.496-24.313-166.51-64.215-5.099-4.622-5.334-12.554-.467-17.42l33.967-33.967c4.474-4.474 11.662-4.717 16.401-.525C170.76 415.336 211.58 432 256.333 432c97.268 0 176-78.716 176-176 0-97.267-78.716-176-176-176-58.496 0-110.28 28.476-142.274 72.333h98.274c6.627 0 12 5.373 12 12v48c0 6.627-5.373 12-12 12z"
                                            />
                                        </svg>
                                        <svg @click="uploadCroppedImage" xmlns="http://www.w3.org/2000/svg" class="bottom-0 ml-2 h-5 w-5 text-gray-600 fill-current cursor-pointer" fill="currentColor" viewBox="0 0 512 512">
                                            <path
                                                fill="currentColor"
                                                d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"
                                            />
                                        </svg>
                                    </template>
                                    <normal-alert v-else></normal-alert>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="step === 'step2'">
                        <div class="p-5">
                            uploading...
                        </div>
                    </div>
                    <div v-if="step === 'step3'" class="p-5 text-center">
                        <div v-if="updateStatus === 'fail'" class="mb-3">上傳失敗，請重新上傳</div>
                        <button @click="closeUploadAvatarForm" class="h-12 text-sm w-32 bg-gray-300 rounded text-white">確定</button>
                    </div>
                </div>
            </div>
            
        </modal>
    </div>
</template>

<script>
import { imageUpload } from "@/api/file/ImageUpload";
import { integer } from 'vee-validate/dist/rules';
import NormalAlert from "@/components/widgets/permission/NormalAlert";

import { CAN_USE_LINK_ITEM_UPLOAD_THUMBNAIL } from "@/enum/permission/vBasic/VPermission";

export default {
    data() {
        return {
            croppa: null,
            croppaSetting: {
                accept: ".png, .jpg, .jpeg, .PNG, .JPG, .JPEG",
                width: 225,
                height: 225,
                placeholder: "請上傳檔案",
                placeholderFontSize: 16,
                placeholderColor: "#333",
                preventWhiteSpace: true,
                fileSizeLimit: 5 * 1024 * 1024,
                // fileSizeLimit: 1
            },
            showHandleArea: false,
            errorMsg: "",
            step: "step1",
            updateStatus: "",
        };
    },
    components: {
        NormalAlert
    },
    props: {
        height: {
            type: Number,
            default: 225,
        },
        width: {
            type: Number,
            default: 225,
        },
        modalName: {
            type: String,
            required: true,
        },
        emitFunction: {
            type: String,
            default: "update-image",
        },
        modalTitle: {
            type: String,
            required: true,
        },
        size: {
            type: Number,
            default: 500,
        },
        modelId: {
            type: String,
            required: true
        },
        modelName: {
            type: String,
            required: true
        },
        fieldName: {
            type: String,
            required: true
        },
        shape: {
            type: String,
            default: 'square' // 'rect'
        }
    },
    computed: {
        croppaSettingSize() {
            if(this.shape === 'rect') {
                return {
                    width: 300,
                    height: 169
                }
            }

            return {
                width: this.width,
                height: this.height
            }
        },
        hasPermission() {
            return this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_UPLOAD_THUMBNAIL);
        },
    },
    methods: {
        openUploadAvatarForm() {
            this.$modal.show(this.modalName);
        },
        closeUploadAvatarForm() {
            this.$modal.hide(this.modalName);
        },
        handleNewImage() {
            this.showHandleArea = true;
            this.clearErrorMsg();
        },
        handleImageRemove() {
            this.showHandleArea = false;
        },
        rotateCroppa() {
            this.croppa.rotate(-1);
        },
        handleCroppaFileSizeExceed(file) {
            // 圖檔超過大小限制
            if (file.size > this.croppaSetting.fileSizeLimit) {
                this.errorMsg = "圖檔超過大小限制";
            }
        },
        clearErrorMsg() {
            this.errorMsg = "";
        },
        uploadCroppedImage() {
            this.croppa.generateBlob(
                (blob) => {
                    this.step = "step2";
                    const formData = new FormData();
                    formData.append("model_id", this.modelId);
                    formData.append("model_name", this.modelName);
                    formData.append("field_name", this.fieldName);
                    formData.append("image", blob);
                    formData.append("size", this.size);

                    imageUpload(formData)
                        .then((rs) => {
                            this.step = "step3";
                            this.$emit(this.emitFunction, rs.data.path, 'succ');

                            this.$modal.hide(this.modalName);
                        })
                        .catch((err) => {
                            console.log(err);
                            this.step = "step3";
                            this.updateStatus = "fail";
                            this.$emit(this.emitFunction, '', 'fail');
                        });
                },
                "image/png",
                0.8
            ); // 80% compressed jpeg file
        },
        beforeClose(event) {
            if (this.step === "step2") {
                event.cancel();
            }
            this.step = "step1";
        },
    },
    mounted() {
        this.croppaSetting.width = this.width;
        this.croppaSetting.height = this.height;
    }
};
</script>
<style lang="scss">
.croppa-container {
    background: #fff !important;
    position: relative;
    // border-radius: 50%;
    // &::before {
    //   content: "";
    //   display: inline-block;
    //   position: absolute;
    //   width: 100%
    // }
}
</style>
