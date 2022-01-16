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

            this.originalContent.customData.background.customBgOn = data.background.customBgOn;
            this.originalContent.customData.background.bgType = data.background.bgType;
            this.originalContent.customData.background.bgName = data.background.bgName;
            this.originalContent.customData.background.bgImage = data.background.bgImage;
            this.originalContent.customData.background.bgColor = data.background.bgColor;
            this.originalContent.customData.background.bgColor2 = data.background.bgColor2;

            this.originalContent.customData.linkButton.buttonName = data.linkButton.buttonName;
            this.originalContent.customData.linkButton.buttonBorder = data.linkButton.buttonBorder;
            this.originalContent.customData.linkButton.buttonRadius = data.linkButton.buttonRadius;
            this.originalContent.customData.linkButton.buttonBgColor = data.linkButton.buttonBgColor;
            this.originalContent.customData.linkButton.buttonTextColor = data.linkButton.buttonTextColor;

            this.originalContent.customData.text.textColor = data.text.textColor;
            
        },
        async saveLayout() {

            try {

                await vBasicPageApi.customDataUpdate({
                    layout_code: this.currentThemeLayout.layoutCode,
                    page_id: this.$store.state.pageId,
                    custom_data: this.originalContent.customData
                })

                // this.$emit('save-custom-data')

                
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
