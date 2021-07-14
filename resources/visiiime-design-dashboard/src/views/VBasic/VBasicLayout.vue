<template>
    <div class="layout">
        <div class="mb-10">
            <div class="text-lg mb-5">LAYOUTS</div>
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
            <div class="text-right">
                <button @click="saveLayout()" class="bg-indigo-500 rounded-sm py-2 px-4 text-white hover:bg-indigo-600"> save </button>
            </div>
        </div>
        <div class="mb-10">
            <div class="text-lg mb-5">BACKGROUNDS</div>
            <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-10">
                <div v-for="bg in backgrounds" :key="bg.bgName">
                    <div @click="changeBackground(bg.bgName)">
                        <div class="mobile-frame">
                            <mobile-phone-mini
                                :preview-image="bg.previewImage"
                                :outter-frame="bg.bgName === customDataBackground.bgName"
                            />
                        </div>
                        <div class="text-center mt-2">{{ bg.displayName }}</div>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-start">
                <color-picker :my-color="customDataBackground.bgColor" :emit-function="'update-background-color'" @update-background-color="updateBackgroundColor" />
                <div class="ml-2 text-gray-600">{{ customDataBackground.bgColor }}</div>
            </div>
        </div>
        <div class="mb-10">
            <div class="text-lg mb-5">BUTTONS</div>
            <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-3">
                <div v-for="btn in buttons" :key="btn.buttonName">
                    <div @click="changeButton(btn.buttonName)" class="cursor-pointer">
                        <link-button :text="btn.displayName" :button-name="btn.buttonName" />
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-10">
            <div class="text-lg mb-5">TEXT COLOR</div>
            <div class="flex items-center justify-start">
                <color-picker :my-color="customDataText.textColor" :emit-function="'update-text-color'" @update-text-color="updateTextColor" />
                <div class="ml-2 text-gray-600">{{ customDataText.textColor }}</div>
            </div>
        </div>
        <upload-modal :emit-function="'update-background-image'" @update-background-image="updateBackgroundImage" />
    </div>
</template>

<script>
import MobilePhoneMini from "@/components/widgets/MobilePhoneMini";
import LayoutVO from "@/vo/design/layout/LayoutVO";
import UploadModal from "@/components/widgets/upload/UploadModal";

import ColorPicker from "@/components/widgets/ColorPicker";
import LinkButton from "@/components/widgets/VBasic/LinkButton";
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";

export default {
    components: {
        MobilePhoneMini,
        UploadModal,
        ColorPicker,
        LinkButton,
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
            backgrounds: [
                {
                    previewImage: "",
                    displayName: "none",
                    bgName: "none",
                    bgType: "",
                },
                {
                    previewImage: "",
                    displayName: "plain",
                    bgName: "bgPlain",
                    bgType: "",
                },
                {
                    previewImage: "",
                    displayName: "bg1",
                    bgName: "bg1",
                    bgType: "svg",
                },
                {
                    previewImage: "",
                    displayName: "gradient animation",
                    bgName: "bg2",
                    bgType: "css",
                },
                {
                    previewImage: "",
                    displayName: "bg3",
                    bgName: "bg3",
                    bgType: "css",
                },
                {
                    previewImage: "",
                    displayName: "bg4",
                    bgName: "bg4",
                    bgType: "css",
                },
                {
                    previewImage: "",
                    displayName: "bgImage",
                    bgName: "bgImage",
                    bgType: "background",
                },
            ],
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
            return this.originalContent.customData.button;
        },
    },
    methods: {
        themeChangeLayout({ layoutCode, layoutName }) {
            let layout = new LayoutVO(layoutName, layoutCode);
            this.currentThemeLayout.layoutName = layout.layoutName;
            this.currentThemeLayout.layoutCode = layout.layoutCode;
            this.currentThemeLayout.layoutClass = layout.layoutClass;
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
                this.$modal.show("uploadModal");
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
        updateBackgroundImage(img) {
            this.customDataBackground.bgContent = img;
            this.customDataBackground.customBgOn = true;
            this.customDataBackground.bgName = "bgImage";
            this.customDataBackground.bgType = "background";
            this.$modal.hide("uploadModal");

            // 更新 bgImagePreviewImage
            this.getBackgroundsOption("bgImage").previewImage = img;
        },
        updateBackgroundColor(color) {
            this.customDataBackground.bgColor = color;
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
        }
    },
    created() {
        if (this.customDataBackground.bgContent !== "") {
            let find = this.getBackgroundsOption("bgImage");
            find.previewImage = this.customDataBackground.bgContent;
        }
    },
    mounted() {
        // this.$modal.show("uploadModal");
    },
};
</script>
