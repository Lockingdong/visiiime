<template>
    <div class="layout">
        <div class="mb-10">
            <v-h3 class="mb-3">精選主題</v-h3>
            <v-card class="mb-3 p-1">
                <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    <div v-for="layout in layouts" :key="layout.layoutCode">
                        <div @click="themeChangeLayout(layout)">
                            <div class="mobile-frame">
                                <mobile-phone-mini :preview-image="layout.layoutImage" :outter-frame="layout.layoutCode === currentThemeLayout.layoutCode" />
                            </div>
                            <div class="text-center mt-2">{{ layout.layoutName }}</div>
                        </div>
                    </div>
                </div>
            </v-card>
            <div class="text-right">
                <v-button @click="saveLayout()">儲存</v-button>
            </div>
        </div>
        <div class="mb-10">
            <v-h3 class="mb-3">自訂背景</v-h3>
            <v-card class="mb-3 p-1">
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
                <div class="flex items-center justify-start">
                    <color-picker :my-color="customDataBackground.bgColor" @update-color="updateBackgroundColor" />
                    <div class="ml-2 text-gray-600">{{ customDataBackground.bgColor }}</div>
                </div>
                <div class="flex items-center justify-start">
                    <color-picker :my-color="customDataBackground.bgColor2" @update-color="updateBackgroundColor2" />
                    <div class="ml-2 text-gray-600">{{ customDataBackground.bgColor2 }}</div>
                </div>
            </v-card>
        </div>
        <div class="mb-10">
            <v-h3 class="mb-3">自訂連結樣式</v-h3>
            <v-card class="mb-3 p-1">
                <div class="text-lg mb-5">BUTTON BORDER</div>
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
                <div class="text-lg mb-5">BUTTON RADIUS</div>
                <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-3 gap-3 mb-5">
                    <div v-for="(btn, idx) in linkButtonOption.buttonRadius" :key="idx">
                        <div class="cursor-pointer">
                            <link-button
                                @click="changeButtonRadius(btn.radiusName)"
                                :text="btn.displayName" :button-radius="btn.radiusName" :filled="false" :color-dark="true"
                                class="mb-3"
                            />
                        </div>
                    </div>
                </div>
                <div class="text-lg mb-5">BUTTON BACKGROUND</div>
                <div class="flex items-center justify-start">
                    <color-picker :my-color="customDataButton.buttonBgColor" @update-color="changeButtonBgColor" />
                    <div class="ml-2 text-gray-600 mr-2">{{ customDataButton.buttonBgColor || 'default' }}</div>
                    <div @click="changeButtonBgColor('transparent')" class="h-10 w-10 border"></div>
                    <div class="ml-2 text-gray-600 mr-2">透明</div>
                </div>
                <div class="text-lg mb-5">BUTTON TEXT COLORS</div>
                <div class="flex items-center justify-start">
                    <color-picker :my-color="customDataButton.buttonTextColor" @update-color="changeButtonTextColor" />
                    <div class="ml-2 text-gray-600">{{ customDataButton.buttonTextColor || 'default' }}</div>
                </div>
            </v-card>
        </div>

        <div class="mb-10">
            <div class="text-lg mb-5">TEXT COLOR</div>
            <div class="flex items-center justify-start">
                <color-picker :my-color="customDataText.textColor" @update-color="updateTextColor" />
                <div class="ml-2 text-gray-600">{{ customDataText.textColor }}</div>
            </div>
        </div>

        <div class="text-right">
            <button @click="saveCustomData()" class="bg-indigo-500 rounded-sm py-2 px-4 text-white hover:bg-indigo-600"> save </button>
        </div>
        <!-- <upload-modal :emit-function="'update-background-image'" @update-background-image="updateBackgroundImage" /> -->
        <upload-image-modal
            :modal-name="'uploadBgModal'"
            :modal-title="'請上傳圖片'"
            @update-image="updateBackgroundImage"
            :height="400"
            :width="225"
        />
    </div>
</template>

<script>
import MobilePhoneMini from "@/components/widgets/MobilePhoneMini";
import MobilePhoneMiniBg from "@/components/widgets/MobilePhoneMiniBg";
import LayoutVO from "@/vo/design/layout/LayoutVO";
import UploadModal from "@/components/widgets/upload/UploadModal";

import ColorPicker from "@/components/widgets/ColorPicker";
import LinkButton from "@/components/widgets/VBasic/LinkButton";
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";

import uploadImageModal from "@/components/widgets/upload/UploadSingleImageModal";

export default {
    components: {
        MobilePhoneMini,
        MobilePhoneMiniBg,
        UploadModal,
        ColorPicker,
        LinkButton,
        uploadImageModal
    },
    props: {
        originalContent: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            color: "#1CA085",
            buttons: [
                {
                    displayName: "rounded",
                    buttonName: "vRounded",
                },
                {
                    displayName: "square",
                    buttonName: "vSquare",
                },
            ],
            linkButtonOption: {
                buttonBorder: [
                    {
                        displayName: 'default',
                        borderName: ''
                    },
                    {
                        displayName: 'border 0px',
                        borderName: 'no-border'
                    },
                    {
                        displayName: 'border 1px',
                        borderName: 'sm-border'
                    },
                    {
                        displayName: 'border 2px',
                        borderName: 'md-border'
                    },
                    {
                        displayName: 'border 3px',
                        borderName: 'lg-border'
                    }
                ],
                buttonRadius: [
                    {
                        displayName: 'default',
                        radiusName: ''
                    },
                    {
                        displayName: 'bdrs 0px',
                        radiusName: 'no-bdrs'
                    },
                    {
                        displayName: 'bdrs 10px',
                        radiusName: 'sm-bdrs'
                    },
                    {
                        displayName: 'bdrs 50px',
                        radiusName: 'md-bdrs'
                    },
                    {
                        displayName: 'bdrs 100px',
                        radiusName: 'lg-bdrs'
                    }
                ]
            }
        };
    },
    computed: {
        layouts() {
            return this.originalContent.availableLayouts;
        },
        currentThemeLayout() {
            return this.originalContent.layout;
        },
        customDataBackground() {
            return this.originalContent.customData.background;
        },
        customDataText() {
            return this.originalContent.customData.text;
        },
        customDataButton() {
            return this.originalContent.customData.linkButton;
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
        }
    },
    methods: {
        themeChangeLayout({ layoutCode, layoutName }) {
            let layout = new LayoutVO(layoutName, layoutCode);
            this.currentThemeLayout.layoutName = layout.layoutName;
            this.currentThemeLayout.layoutCode = layout.layoutCode;
            this.currentThemeLayout.layoutClass = layout.layoutClass;
            this.customDataBackground.customBgOn = false;
            this.customDataBackground.bgName = 'none';
        },
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
        changeButton(buttonName) {
            if (this.customDataButton.buttonName === buttonName) {
                this.customDataButton.buttonName = "";
            } else {
                this.customDataButton.buttonName = buttonName;
            }
        },
        changeButtonBorder(border) {
            this.customDataButton.buttonBorder = border
        },
        changeButtonRadius(radius) {
            this.customDataButton.buttonRadius = radius
        },
        changeButtonBgColor(color) {
            this.customDataButton.buttonBgColor = color
        },
        changeButtonTextColor(color) {
            this.customDataButton.buttonTextColor = color
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
        getBackgroundsOption(type) {
            return this.backgrounds.find((item) => item.bgName === type);
        },
        saveLayout() {
            vBasicPageApi.layoutUpdate({
                page_id: this.$store.state.pageId,
                layout_code: this.currentThemeLayout.layoutCode
            }).then(rs => {
                // todo ...
            }).catch(error => {

            });
        },
        saveCustomData() {
            vBasicPageApi.customDataUpdate({
                page_id: this.$store.state.pageId,
                custom_data: this.originalContent.customData
            }).then(() => {

                // todo
            }).catch(error => {
                console.log(error)
            });
        }
    },
    created() {
        if (this.customDataBackground.bgImage !== "") {
            let find = this.getBackgroundsOption("bgImage");
            find.previewImage = this.customDataBackground.bgImage;
        }
    },
    mounted() {

        // console.log(this.originalContent.customData.background)
        // this.$modal.show("uploadModal");
    },
};
</script>
