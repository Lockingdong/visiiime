<template>
    <div class="mb-10">
        <div class="text-xl mb-3">Visiiime精選</div>
        <div class="card shadow-md mb-3 p-3 bg-white">
            <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-3">
                <div v-for="layout in layouts" :key="layout.layoutCode">
                    <div @click="themeChangeLayout(layout)">
                        <div class="mobile-frame">
                            <mobile-phone-mini :layout-code="layout.layoutCode" :preview-image="layout.layoutImage" :outter-frame="layout.layoutCode === currentThemeLayout.layoutCode" />
                        </div>
                        <div class="text-center mt-1 uppercase text-sm">{{ layout.layoutName }}</div>
                    </div>
                </div>
            </div>
            <div class="text-right mt-5">
                <button
                    v-show="showSave"
                    @click="saveLayout()"
                    :class="{loading: loading}"
                    class="btn btn-primary"
                >儲存變更</button>
            </div>
        </div>
    </div>
</template>
<script>
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";
import MobilePhoneMini from "@/components/widgets/MobilePhoneMini";
import LayoutVO from "@/vo/design/layout/LayoutVO";
import layout from "@/layout"
import { baseUrl } from '@/helper/env'
import { CAN_USE_LAYOUT_CUSTOM_DATA } from "@/enum/permission/vBasic/VPermission";

export default {
    data() {
        return {
            serverError: false,
            loading: false,
            layouts: [],
        }
    },
    components: {
        MobilePhoneMini,
    },
    props: {
        originalContent: {
            type: Object,
            required: true
        },
        showSave: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        availableLayouts() {
            return this.originalContent.availableLayouts;
        },
        customDataBackground() {
            return this.originalContent.customData.background;
        },
        currentThemeLayout() {
            return this.originalContent.layout;
        },
        hasPermission() {
            return this.$store.getters.hasPermission(CAN_USE_LAYOUT_CUSTOM_DATA);
        },
    },
    methods: {
        async themeChangeLayout({ layoutCode, layoutName }) {
            if(this.currentThemeLayout.layoutCode !== layoutCode) {
                this.$emit('show-save-button', true)
            }

            let layout = new LayoutVO(layoutName, layoutCode);
            this.currentThemeLayout.layoutName = layout.layoutName;
            this.currentThemeLayout.layoutCode = layout.layoutCode;
            this.currentThemeLayout.layoutClass = layout.layoutClass;

            let data = await layout.getLayoutData();

            this.setCustomDataByLayoutData(data);
            
        },
        setCustomDataByLayoutData(layoutObj) {
            this.originalContent.customData.background.customBgOn = layoutObj.background.customBgOn;
            this.originalContent.customData.background.bgType = layoutObj.background.bgType;
            this.originalContent.customData.background.bgName = layoutObj.background.bgName;
            this.originalContent.customData.background.bgImage = layoutObj.background.bgImage;
            this.originalContent.customData.background.bgColor = layoutObj.background.bgColor;
            this.originalContent.customData.background.bgColor2 = layoutObj.background.bgColor2;

            this.originalContent.customData.linkButton.buttonName = layoutObj.linkButton.buttonName;
            this.originalContent.customData.linkButton.buttonBorder = layoutObj.linkButton.buttonBorder;
            this.originalContent.customData.linkButton.buttonRadius = layoutObj.linkButton.buttonRadius;
            this.originalContent.customData.linkButton.buttonBgColor = layoutObj.linkButton.buttonBgColor;
            this.originalContent.customData.linkButton.buttonTextColor = layoutObj.linkButton.buttonTextColor;

            this.originalContent.customData.text.textColor = layoutObj.text.textColor;
        },
        async saveLayout() {

            try {

                if(!this.hasPermission) {
                    let layout = new LayoutVO(this.currentThemeLayout.layoutCode, this.currentThemeLayout.layoutCode);
                    let data = await layout.getLayoutData();

                    this.setCustomDataByLayoutData(data);
                
                }

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

            } catch (error) {

                console.log(error)

                this.loading = false;
                this.serverError = true;
                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: error.response.data.data
                })
                
            }

        },
    },
    mounted() {

        layout.forEach(ly => {
            this.layouts.push({
                layoutCode: ly,
                layoutImage: baseUrl() + '/VBasic/' + ly + '.png',
                layoutName: ly,
            })
        });

        // for (let ly of layout) {
        //     let data = await import('@/layout/' + ly + '.js')
        //     layouts.push({
        //         layoutImage: '',
        //         layoutCode:
        //     })
        //     console.log(data.default)
            
        // }
    }
}
</script>
