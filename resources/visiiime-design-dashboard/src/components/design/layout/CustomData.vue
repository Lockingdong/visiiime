<template>
    <div>
        <div class="inline-block text-xl font-medium border-b-4 lg:text-2xl text-base-content border-primary mb-3">客製化主題</div>
        <div class="card shadow-md bg-white relative overflow-visible">
            <div class="mb-10">
                <div class="mb-3 p-5 bg-white relative rounded-2xl">
                    <div class="text-xl mb-3 font-medium">自訂樣式</div>
                    <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-10">
                        <div v-for="bg in backgrounds" :key="bg.bgName">
                            <div @click="changeBackground(bg.bgName)">
                                <div class="mobile-frame">
                                    <mobile-phone-mini-bg
                                        :outter-frame="bg.bgName === customDataBackground.bgName"
                                        :background-obj="bg"
                                    />
                                </div>
                                <div class="text-center mt-1 text-sm">{{ bg.displayName }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="text-sm mb-1">色彩一</div>
                        <div class="flex items-center justify-start">
                            <color-picker :my-color="customDataBackground.bgColor" @update-color="updateBackgroundColor" />
                            <div class="ml-2 text-gray-600">
                                <div class="badge badge-outline uppercase">{{ customDataBackground.bgColor || '無色彩' }}</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="text-sm mb-1">色彩二</div>
                        <div class="flex items-center justify-start">
                            <color-picker :my-color="customDataBackground.bgColor2" @update-color="updateBackgroundColor2" />
                            <div class="ml-2 text-gray-600">
                                <div class="badge badge-outline uppercase">{{ customDataBackground.bgColor2 || '無色彩' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5 border-t border-gray-200">
                <div class="mb-3 p-5 bg-white relative">
                    <div class="text-xl mb-3 font-medium">風格設定</div>
                    <div class="text-md mb-5">按鈕邊框</div>
                    <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-3 mb-5">
                        <div v-for="(btn, idx) in linkButtonOption.buttonBorder" :key="idx">
                            <div class="cursor-pointer">
                                <link-button
                                    @click="changeButtonBorder(btn.borderName)"
                                    :text="btn.displayName" :button-border="btn.borderName" :filled="false" :color-dark="true"
                                    :outter-frame="btn.borderName === customDataButton.buttonBorder"
                                    class="mb-3"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="text-md mb-5">按鈕圓角</div>
                    <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-3 mb-5">
                        <div v-for="(btn, idx) in linkButtonOption.buttonRadius" :key="idx">
                            <div class="cursor-pointer">
                                <link-button
                                    @click="changeButtonRadius(btn.radiusName)"
                                    :text="btn.displayName" :button-radius="btn.radiusName"
                                    :outter-frame="btn.radiusName === customDataButton.buttonRadius"
                                    class="mb-3"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="text-md mb-2">按鈕背景</div>
                    <div class="flex items-center justify-start mb-5">
                        <color-picker :my-color="customDataButton.buttonBgColor" @update-color="changeButtonBgColor" />
                        <div class="ml-2 text-gray-600 mr-3">
                            <div v-show="customDataButton.buttonBgColor === 'transparent'" class="badge badge-outline uppercase">透明</div>
                            <div v-show="customDataButton.buttonBgColor !== 'transparent'" class="badge badge-outline uppercase">{{ customDataButton.buttonBgColor || '透明' }}</div>
                        </div>
                        <!-- <div @click="changeButtonBgColor('transparent')" class="h-10 w-10 border transparent cursor-pointer"></div>
                        <div class="ml-2 text-gray-600 mr-2">
                            <div class="badge badge-outline">透明</div>
                        </div> -->
                    </div>
                    <div class="text-md mb-2">按鈕文字顏色</div>
                    <div class="flex items-center justify-start mb-5">
                        <color-picker :my-color="customDataButton.buttonTextColor" @update-color="changeButtonTextColor" />
                        <div class="ml-2 text-gray-600">
                            <div class="badge badge-outline uppercase">{{ customDataButton.buttonTextColor || '預設色彩' }}</div>
                        </div>
                    </div>
                    <div class="mb-10">
                        <div class="text-md mb-2">頁面文字顏色</div>
                        <div class="flex items-center justify-start mb-5">
                            <color-picker :my-color="customDataText.textColor" @update-color="updateTextColor" />
                            <div class="ml-2 text-gray-600">
                                <div class="badge badge-outline uppercase">{{ customDataText.textColor || '預設色彩' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-5 border-t border-gray-200">
                <div class="p-5">
                    <div class="mb-10">
                        <!-- <div class="text-lg mb-2">顯示贊助</div> -->
                        <div class="flex items-center justify-start mb-5">
                            <div class="ml-2 text-gray-600">
                                
                                <label class="cursor-pointer label">
                                    <input v-model="customDataSupport.display" type="checkbox" checked="checked" class="checkbox checkbox-primary mr-5">
                                    <span class="label-text text-lg">顯示贊助</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div v-if="hasPermission" class="text-right px-5">
                        <button
                            v-show="showSave"
                            @click="saveCustomData()"
                            :class="{loading: loading}"
                            class="btn btn-primary"
                        >儲存變更</button>
                    </div>
                </div>
            </div>
            <template v-if="!hasPermission">
                <div class="absolute left-0 top-0 w-full h-full bg-white opacity-90 card">
                </div>
                <div class="absolute left-0 top-0 w-full h-full bg-transparent flex justify-center items-center card">
                    <normal-alert></normal-alert>
                </div>
            </template>

            <!-- <upload-modal :emit-function="'update-background-image'" @update-background-image="updateBackgroundImage" /> -->
            <upload-image-modal
                :modal-name="'uploadBgModal'"
                :modal-title="'請上傳圖片'"
                @update-image="updateCustomBackgroundImage"
                :height="400"
                :width="225"
                :size="600"
                :model-id="$store.state.pageId"
                :model-name="'VPage'"
                :field-name="'customBackground'"
            />

            <bg-type-select-modal 
                @choose-layout="updateBackgroundImage"
                @choose-custom="updateBackgroundImage"
                @choose-upload="chooseUpload"
            />
        </div>
    </div>
</template>
<script>
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";
import MobilePhoneMini from "@/components/widgets/MobilePhoneMini";
import LayoutVO from "@/vo/design/layout/LayoutVO";
import LinkButton from "@/components/widgets/VBasic/LinkButton";
import ColorPicker from "@/components/widgets/ColorPicker";

import MobilePhoneMiniBg from "@/components/widgets/MobilePhoneMiniBg";
import { CAN_USE_LAYOUT_CUSTOM_DATA } from "@/enum/permission/vBasic/VPermission";
import NormalAlert from "@/components/widgets/permission/NormalAlert";


import BgTypeSelectModal from "@/components/widgets/upload/BgTypeSelectModal";
import uploadImageModal from "@/components/widgets/upload/UploadSingleImageModal";

import helperMixin from "@/mixins/VBasic/HelperMixin";
import { baseUrl } from '@/helper/env'

export default {
    mixins: [
        helperMixin
    ],
    data() {
        return {
            color: "#1CA085",
            linkButtonOption: {
                buttonBorder: [
                    // {
                    //     displayName: '預設邊框',
                    //     borderName: ''
                    // },
                    {
                        displayName: '無邊框',
                        borderName: 'no-border'
                    },
                    {
                        displayName: '細',
                        borderName: 'sm-border'
                    },
                    {
                        displayName: '粗',
                        borderName: 'md-border'
                    },
                    {
                        displayName: '超粗',
                        borderName: 'lg-border'
                    }
                ],
                buttonRadius: [
                    // {
                    //     displayName: '預設圓角',
                    //     radiusName: ''
                    // },
                    {
                        displayName: '直角',
                        radiusName: 'no-bdrs'
                    },
                    {
                        displayName: '微圓',
                        radiusName: 'sm-bdrs'
                    },
                    {
                        displayName: '圓',
                        radiusName: 'md-bdrs'
                    },
                    {
                        displayName: '超圓',
                        radiusName: 'lg-bdrs'
                    }
                ]
            },
            serverError: false,
            loading: false,
            modalData: {
                name: 'custom-data',
                header: '',
                content: '',
            }
        }
    },
    components: {
        MobilePhoneMiniBg,
        uploadImageModal,
        BgTypeSelectModal,
        LinkButton,
        ColorPicker,
        NormalAlert
    },
    props: {
        originalContent: {
            type: Object,
            required: true
        },
        showSave: {
            type: Boolean,
            default: false
        },
    },
    computed: {
        apiLoaded() {
            return this.helperMixin_pageApiLoaded;
        },
        hasPermission() {
            return this.$store.getters.hasPermission(CAN_USE_LAYOUT_CUSTOM_DATA);
        },
        layouts() {
            return this.originalContent.availableLayouts;
        },
        currentThemeLayout() {
            return this.originalContent.layout;
        },
        backgrounds() {
            let defaultLayout = this.layouts.find(item => {
                return item.layoutCode === this.currentThemeLayout.layoutCode
            });

            let defaultLayoutImage = (defaultLayout === undefined) ? '' : defaultLayout.layoutImage;

            return [
                // {
                //     previewImage: defaultLayoutImage,
                //     displayName: "預設",
                //     bgName: "none",
                //     bgType: "",
                //     bgColor: '',
                //     bgColor2: ''
                // },
                {
                    previewImage: "",
                    displayName: "素色",
                    bgName: "bgPlain",
                    bgType: "",
                    bgColor: this.originalContent.customData.background.bgColor,
                    bgColor2: ''
                },
                {
                    previewImage: "",
                    displayName: "漸層",
                    bgName: "bgGradient",
                    bgType: "",
                    bgColor: this.originalContent.customData.background.bgColor,
                    bgColor2: this.originalContent.customData.background.bgColor2,
                },
                // {
                //     previewImage: "",
                //     displayName: "波浪",
                //     bgName: "bgWave",
                //     bgType: "svg",
                //     bgColor: this.originalContent.customData.background.bgColor,
                //     bgColor2: this.originalContent.customData.background.bgColor2,
                // },
                // {
                //     previewImage: "",
                //     displayName: "gradient animation",
                //     bgName: "bg2",
                //     bgType: "css",
                // },
                // {
                //     previewImage: "",
                //     displayName: "bg3",
                //     bgName: "bg3",
                //     bgType: "css",
                // },
                // {
                //     previewImage: "",
                //     displayName: "bg4",
                //     bgName: "bg4",
                //     bgType: "css",
                // },
                {
                    previewImage: this.originalContent.customData.background.bgImage,
                    displayName: "背景",
                    bgName: "bgImage",
                    bgType: "background",
                    bgColor: '',
                    bgColor2: ''
                },
            ];
        },
        customDataBackground() {
            return this.originalContent.customData.background;
        },
        customDataButton() {
            return this.originalContent.customData.linkButton;
        },
        customDataText() {
            return this.originalContent.customData.text;
        },
        customDataSupport() {
            return this.originalContent.customData.support;
        },
    },
    methods: {
        changeBackground(bgName) {
            if (bgName === "none") {
                this.customDataBackground.customBgOn = false;
                this.customDataBackground.bgName = bgName;
                return;
            }

            if (bgName === "bgImage") {
                this.handleBgImage()
                return;
            }
            this.customDataBackground.customBgOn = true;
            this.customDataBackground.bgName = bgName;
        },
        async handleBgImage() {
            let find = this.getBackgroundsOption("bgImage");
            if (find.previewImage !== "") {
                this.updateBackgroundImage(find.previewImage);
            }

            // this.$modal.show("uploadBgModal");
            let layout = this.originalContent.availableLayouts.find(item => item.layoutCode === this.currentThemeLayout.layoutCode);

            let layoutData = JSON.parse(layout.layoutSetting)

            this.$modal.show("BgTypeSelectModal", {
                layoutBg: layoutData.background.bgImage,
                customBg: this.customDataBackground.bgCustomImage
            });
        },
        getBackgroundsOption(type) {
            return this.backgrounds.find((item) => item.bgName === type);
        },
        chooseUpload() {
            this.$modal.show("uploadBgModal");
            this.$modal.hide("BgTypeSelectModal");
        },
        updateBackgroundImage(img) {
            this.customDataBackground.bgImage = img;
            this.customDataBackground.customBgOn = true;
            this.customDataBackground.bgName = "bgImage";
            this.customDataBackground.bgType = "background";

            // 更新 bgImagePreviewImage
            this.getBackgroundsOption("bgImage").previewImage = img;
            this.$modal.hide("BgTypeSelectModal");
        },
        updateCustomBackgroundImage(img){
            vBasicPageApi.customDataUpdate({
                layout_code: this.currentThemeLayout.layoutCode,
                page_id: this.$store.state.pageId,
                custom_data: this.originalContent.customData
            }).then(() => {
                this.customDataBackground.bgCustomImage = img;
                this.customDataBackground.customBgOn = true;
                this.customDataBackground.bgName = "bgImage";
                this.customDataBackground.bgType = "background";
                this.$modal.hide("uploadBgModal");

                // 更新 bgImagePreviewImage
                this.updateBackgroundImage(img);

                this.$modal.show('result-modal', {
                    header: '上傳成功',
                })

            }).catch(err => {
                console.log(err)
                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: err.response.data.data
                })
            })

        },
        updateBackgroundColor(color) {
            this.customDataBackground.bgColor = color;
        },
        updateBackgroundColor2(color) {
            this.customDataBackground.bgColor2 = color;
        },
        updateTextColor(color) {
            this.customDataText.textColor = color;
        },
        changeButtonBgColor(color) {
            if(color === '') {
                this.customDataButton.buttonBgColor = 'transparent'
                return
            }
            this.customDataButton.buttonBgColor = color
        },
        changeButtonTextColor(color) {
            this.customDataButton.buttonTextColor = color
        },
        changeButtonRadius(radius) {
            this.customDataButton.buttonRadius = radius
        },
        changeButtonBorder(border) {
            this.customDataButton.buttonBorder = border
        },
        async saveCustomData() {

            try {
                await vBasicPageApi.customDataUpdate({
                    layout_code: this.currentThemeLayout.layoutCode,
                    page_id: this.$store.state.pageId,
                    custom_data: this.originalContent.customData
                })

                this.loading = false;
                this.serverError = false;
                this.$emit('show-save-button', false)
                this.$modal.show('result-modal', {
                    header: '更新成功',
                })
                
            } catch (err) {

                console.log(err)

                this.loading = false;
                this.serverError = true;
                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: err.response.data.data
                })
                
            }
        },
        watchOriginalContent() {
            if(this.apiLoaded) {
                this.$watch('originalContent.customData', () => {
                    this.$emit('show-save-button', true)
                }, {deep: true});
            }
        }
    },
    watch: {
        apiLoaded(nv) {
            if(nv) {
                this.watchOriginalContent();
            }
        }
    },
    created() {
        if (this.customDataBackground.bgImage !== "") {
            let find = this.getBackgroundsOption("bgImage");
            find.previewImage = this.customDataBackground.bgImage;
        }
    },
    mounted() {
        this.watchOriginalContent();
    }
}
</script>
<style scoped>
.transparent {
    width: 42px;
    height: 42px;
    background-color: rgb(255, 255, 255);
    border-radius: 10px;
    border: 2px solid #eee;
}

</style>
