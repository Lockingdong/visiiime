<template>
    <div class="mb-10">
        <div class="inline-block text-xl font-medium border-b-4 lg:text-2xl text-base-content border-primary mb-3">Visiiime精選</div>
        <div class="card shadow-md mb-3 p-3 bg-white">
            <div class="mb-5 p-1">
                <div class="tabs">
                    <a @click="changeBgName('bgGradient')" :class="{'tab-active': layoutBgName === 'bgGradient'}" class="tab tab-lifted">漸層</a> 
                    <a @click="changeBgName('bgPlain')" :class="{'tab-active': layoutBgName === 'bgPlain'}" class="tab tab-lifted">素色</a> 
                    <a @click="changeBgName('bgImage')" :class="{'tab-active': layoutBgName === 'bgImage'}" class="tab tab-lifted">背景</a>
                </div> 
            </div>
            <div class="grid grid-cols-3 md:grid-cols-3 lg:grid-cols-4 gap-3" :key="key">
                <div v-for="layout in displayedLayouts" :key="layout.id">
                    <div @click="themeChangeLayout(layout)">
                        <div class="mobile-frame">
                            <mobile-phone-mini :layout="layout" :outter-frame="layout.layoutCode === currentThemeLayout.layoutCode"/>
                        </div>
                        <div class="text-center uppercase text-xs md:text-sm">{{ layout.layoutDisplayName }}</div>
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
import { baseUrl } from '@/helper/env'
import { CAN_USE_LAYOUT_CUSTOM_DATA } from "@/enum/permission/vBasic/VPermission";
export default {
    data() {
        return {
            serverError: false,
            loading: false,
            layoutBgName: 'bgGradient',
            displayedLayouts: [],
            key: 0
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
        async themeChangeLayout(layout) {

            // check user role
            if(layout.layoutRole === 'VVIP' && layout.layoutRole !== this.$store.state.userRole) {
                this.$modal.show('result-modal', {
                    header: '升級為 Visiiime Pro 即可享有此主題',
                    content: '<a href="/pricing" class="underline">前往升級方案</a>'
                })
                return;
            }

            if(this.currentThemeLayout.layoutCode !== layout.layoutCode) {
                this.$emit('show-save-button', true)
            }

            this.currentThemeLayout.layoutCode = layout.layoutCode;

            this.setCustomDataByLayoutData(JSON.parse(layout.layoutSetting));            
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
                    let layout = this.availableLayouts.find(layout => layout.layoutCode === this.currentThemeLayout.layoutCode);

                    this.setCustomDataByLayoutData(JSON.parse(layout.layoutSetting));
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
        filterBgName(bgName) {
            return this.availableLayouts.filter(layout => {
                return layout.layoutBgName === bgName
            })
        },
        changeBgName(bgName) {
            this.key += 1
            this.layoutBgName = bgName
            this.displayedLayouts = this.filterBgName(bgName)
        }
    },
    watch: {
        availableLayouts() {
            this.displayedLayouts = this.filterBgName('bgGradient')
        }
    },
    mounted() {
        this.displayedLayouts = this.filterBgName('bgGradient')
    }
}
</script>
