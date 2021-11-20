<template>
    <div class="card shadow-md bg-white">
        <div class="mb-10">

            <div class="mb-3 p-5 bg-white relative">
                <div class="text-2xl mb-3">自訂樣式</div>
                <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-10">
                    <div v-for="bg in backgrounds" :key="bg.bgName">
                        <div @click="changeBackground(bg.bgName)">
                            <div class="mobile-frame">
                                <mobile-phone-mini-bg
                                    :outter-frame="bg.bgName === customDataBackground.bgName"
                                    :background-obj="bg"
                                />
                            </div>
                            <div class="text-center mt-2">{{ bg.displayName }}</div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <div class="text-sm mb-1">色彩一</div>
                    <div class="flex items-center justify-start">
                        <color-picker :my-color="customDataBackground.bgColor" @update-color="updateBackgroundColor" />
                        <div class="ml-2 text-gray-600">
                            <div class="badge badge-outline">{{ customDataBackground.bgColor || '無色彩' }}</div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="text-sm mb-1">色彩二</div>
                    <div class="flex items-center justify-start">
                        <color-picker :my-color="customDataBackground.bgColor2" @update-color="updateBackgroundColor2" />
                        <div class="ml-2 text-gray-600">
                            <div class="badge badge-outline">{{ customDataBackground.bgColor2 || '無色彩' }}</div>
                        </div>
                    </div>
                </div>
                <template v-if="!hasPermission">
                    <div class="absolute left-0 top-0 w-full h-full bg-white opacity-90">
                    </div>
                    <div class="absolute left-0 top-0 w-full h-full bg-transparent flex justify-center items-center">
                        <div class="text-gray-800 text-lg text-center">
                            <fai class="text-gray-800 text-2xl" :icon="['fa', 'lock']" />
                            <p>You have no permission to access this feature.</p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
        <div class="mb-5 border-t border-gray-200">
            <div class="mb-3 p-5 bg-white relative">
                <div class="text-2xl mb-3">按鈕風格設定</div>
                <div class="text-lg mb-5">按鈕邊框</div>
                <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-3 mb-5">
                    <div v-for="(btn, idx) in linkButtonOption.buttonBorder" :key="idx">
                        <div class="cursor-pointer">
                            <link-button
                                @click="changeButtonBorder(btn.borderName)"
                                :text="btn.displayName" :button-border="btn.borderName" :filled="false" :color-dark="true"
                                class="mb-3"
                            />
                        </div>
                    </div>
                </div>
                <div class="text-lg mb-5">按鈕圓角</div>
                <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-3 mb-5">
                    <div v-for="(btn, idx) in linkButtonOption.buttonRadius" :key="idx">
                        <div class="cursor-pointer">
                            <link-button
                                @click="changeButtonRadius(btn.radiusName)"
                                :text="btn.displayName" :button-radius="btn.radiusName"
                                class="mb-3"
                            />
                        </div>
                    </div>
                </div>
                <div class="text-lg mb-2">按鈕背景</div>
                <div class="flex items-center justify-start mb-5">
                    <color-picker :my-color="customDataButton.buttonBgColor" @update-color="changeButtonBgColor" :allow-transparent="true" />
                    <div class="ml-2 text-gray-600 mr-3">
                        <div class="badge badge-outline">{{ customDataButton.buttonBgColor || '預設色彩' }}</div>
                    </div>
                    <div @click="changeButtonBgColor('transparent')" class="h-10 w-10 border transparent cursor-pointer"></div>
                    <div class="ml-2 text-gray-600 mr-2">
                        <div class="badge badge-outline">透明</div>
                    </div>
                </div>
                <div class="text-lg mb-2">按鈕文字顏色</div>
                <div class="flex items-center justify-start mb-5">
                    <color-picker :my-color="customDataButton.buttonTextColor" @update-color="changeButtonTextColor" />
                    <div class="ml-2 text-gray-600">
                        <div class="badge badge-outline">{{ customDataButton.buttonTextColor || '預設色彩' }}</div>
                    </div>
                </div>
                <div class="mb-10">
                    <div class="text-lg mb-2">其他文字顏色</div>
                    <div class="flex items-center justify-start mb-5">
                        <color-picker :my-color="customDataText.textColor" @update-color="updateTextColor" />
                        <div class="ml-2 text-gray-600">
                            <div class="badge badge-outline">{{ customDataText.textColor || '預設色彩' }}</div>
                        </div>
                    </div>
                </div>
                <template v-if="!hasPermission">
                    <div class="absolute left-0 top-0 w-full h-full bg-white opacity-90">
                    </div>
                    <div class="absolute left-0 top-0 w-full h-full bg-transparent flex justify-center items-center">
                        <div class="text-gray-800 text-lg text-center">
                            <fai class="text-gray-800 text-2xl" :icon="['fa', 'lock']" />
                            <p>You have no permission to access this feature.</p>
                        </div>
                    </div>
                </template>
            </div>
            <div class="text-right px-5">
                <button
                    v-show="showSave"
                    @click="saveCustomData()"
                    :class="{loading: loading}"
                    class="btn btn-primary"
                >儲存變更</button>
            </div>
        </div>

        <!-- <upload-modal :emit-function="'update-background-image'" @update-background-image="updateBackgroundImage" /> -->
        <upload-image-modal
            :modal-name="'uploadBgModal'"
            :modal-title="'請上傳圖片'"
            @update-image="updateBackgroundImage"
            :height="400"
            :width="225"
            :size="600"
            :model-id="$store.state.pageId"
            :model-name="'VPage'"
            :field-name="'customBackground'"
        />
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

import uploadImageModal from "@/components/widgets/upload/UploadSingleImageModal";

import helperMixin from "@/mixins/VBasic/HelperMixin";

export default {
    mixins: [
        helperMixin
    ],
    data() {
        return {
            color: "#1CA085",
            linkButtonOption: {
                buttonBorder: [
                    {
                        displayName: '預設邊框',
                        borderName: ''
                    },
                    {
                        displayName: '無',
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
                    {
                        displayName: '預設圓角',
                        radiusName: ''
                    },
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
            showSave: false,
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
        LinkButton,
        ColorPicker,
    },
    props: {
        originalContent: {
            type: Object,
            required: true
        }
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
                {
                    previewImage: defaultLayoutImage,
                    displayName: "預設",
                    bgName: "none",
                    bgType: "",
                    bgColor: '',
                    bgColor2: ''
                },
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
                {
                    previewImage: "",
                    displayName: "波浪",
                    bgName: "bgWave",
                    bgType: "svg",
                    bgColor: this.originalContent.customData.background.bgColor,
                    bgColor2: this.originalContent.customData.background.bgColor2,
                },
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
                    displayName: "上傳背景",
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
    },
    methods: {
        changeBackground(bgName) {
            if (bgName === "none") {
                this.customDataBackground.customBgOn = false;
                this.customDataBackground.bgName = bgName;
                return;
            }

            if (bgName === "bgImage") {
                let find = this.getBackgroundsOption("bgImage");
                if (find.previewImage !== "") {
                    this.updateBackgroundImage(find.previewImage);
                }
                this.$modal.show("uploadBgModal");
                return;
            }
            this.customDataBackground.customBgOn = true;
            this.customDataBackground.bgName = bgName;
        },
        getBackgroundsOption(type) {
            return this.backgrounds.find((item) => item.bgName === type);
        },
        updateBackgroundImage(img) {
            this.customDataBackground.bgImage = img;
            this.customDataBackground.customBgOn = true;
            this.customDataBackground.bgName = "bgImage";
            this.customDataBackground.bgType = "background";
            this.$modal.hide("uploadBgModal");

            // 更新 bgImagePreviewImage
            this.getBackgroundsOption("bgImage").previewImage = img;
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
        saveCustomData() {
            if(!this.hasPermission) {
                // todo
                alert(`401 permission deny`)
                return;
            }
            vBasicPageApi.customDataUpdate({
                page_id: this.$store.state.pageId,
                custom_data: this.originalContent.customData
            }).then(() => {
                this.loading = false;
                this.serverError = false;
                this.showSave = false;
                this.$modal.show('result-modal', {
                    header: '更新成功',
                })
            }).catch(err => {
                console.log(err)
                this.loading = false;
                this.serverError = true;
                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: err.response.data.data
                })
            });
        },
        watchOriginalContent() {
            if(this.apiLoaded) {
                this.$watch('originalContent.customData', () => {
                    this.showSave = true;
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
