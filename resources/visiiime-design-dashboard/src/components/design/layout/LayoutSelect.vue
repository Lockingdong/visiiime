<template>
    <div class="mb-10">
        <div class="text-2xl mb-3">精選主題</div>
        <div class="card shadow-md mb-3 p-3 bg-white">
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

export default {
    data() {
        return {
            serverError: false,
            loading: false,
            showSave: false,
        }
    },
    components: {
        MobilePhoneMini,
    },
    props: {
        originalContent: {
            type: Object,
            required: true
        }
    },
    computed: {
        layouts() {
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
        themeChangeLayout({ layoutCode, layoutName }) {

            if(this.currentThemeLayout.layoutCode !== layoutCode) {
                this.showSave = true
            }

            let layout = new LayoutVO(layoutName, layoutCode);
            this.currentThemeLayout.layoutName = layout.layoutName;
            this.currentThemeLayout.layoutCode = layout.layoutCode;
            this.currentThemeLayout.layoutClass = layout.layoutClass;
            this.customDataBackground.customBgOn = false;
            this.customDataBackground.bgName = 'none';
        },
        saveLayout() {
            vBasicPageApi.layoutUpdate({
                page_id: this.$store.state.pageId,
                layout_code: this.currentThemeLayout.layoutCode
            }).then(rs => {
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
    }
}
</script>
