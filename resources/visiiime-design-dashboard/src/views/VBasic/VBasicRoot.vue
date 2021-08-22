<template>
    <div>
        <base-root>
            <template #router>
                <router-view class="max-w-xl mx-auto" :original-content="originalContent" @remove-link-item="linkItemListMixin_removeLinkItem" />
            </template>

            <template #theme>
                <!-- <pre class="text-xs overflow-scroll h-full">
                    {{ pageContent }}
                    {{ originalContent }}
                </pre> -->
                <v-basic-theme :theme-content="pageContent" :is-demo="true" />
            </template>
        </base-root>
    </div>
</template>

<script>
import AvatarMixin from "@/mixins/VBasic/profile/AvatarMixin";
import UserTitleMixin from "@/mixins/VBasic/profile/UserTitleMixin";
import DescriptionMixin from "@/mixins/VBasic/profile/DescriptionMixin";
import LinkItemListMixin from "@/mixins/VBasic/linkItemList/LinkItemListMixin";
import SocialLinksMixin from "@/mixins/VBasic/socialLinks/SocialLinksMixin";
import LayoutMixin from "@/mixins/VBasic/layout/LayoutMixin";
import CustomDataMixin from "@/mixins/VBasic/customData/CustomDataMixin";
import UrlMixin from "@/mixins/VBasic/setting/UrlMixin";
import AnalysticMixin from "@/mixins/VBasic/setting/AnalysticMixin";
import SeoMixin from "@/mixins/VBasic/setting/SeoMixin";

import VBasicThemeVO from "@/vo/theme/VBasicThemeVO";
import MobilePhone from "@/components/widgets/MobilePhone";
import VBasicTheme from "@/components/themes/VBasic/VBasicTheme";

import VBasicCustomDataVO from "@/vo/theme/customData/VBasic/VBasicCustomDataVO";

import BaseRoot from "../BaseRoot";
import getAvailableLayouts from "@/api/VBasic/getAvailableLayouts";

import vBasicPageApi from "@/api/VBasic/VBasicPageApi";
import vLayoutApi from "@/api/VBasic/VLayoutApi";

import { isProd } from "@/helper/env";

export default {
    name: "VBasic",
    components: {
        MobilePhone,
        VBasicTheme,
        BaseRoot,
    },
    mixins: [
        AvatarMixin,
        UserTitleMixin,
        DescriptionMixin,
        LinkItemListMixin,
        SocialLinksMixin,
        LayoutMixin,
        CustomDataMixin,
        UrlMixin,
        AnalysticMixin,
        SeoMixin
    ],
    data() {
        return {
            pageId: "",
            availableLayouts: [],
            customData: {
                type: VBasicCustomDataVO,
                required: true,
            },
            mbPhone: false,
        };
    },
    computed: {
        originalContent() {
            return {
                avatar: this.avatarMixin_avatar,
                userTitle: this.userTitleMixin_userTitle,
                description: this.descriptionMixin_description,
                linkItemListMain: this.linkItemListMixin_listMain,
                linkItemList: this.linkItemListMixin_list,
                socialLinks: this.socialLinksMixin_list,
                layout: this.layoutMixin_layout,
                availableLayouts: this.availableLayouts,
                customData: this.customdDataMixin_customData,
                url: this.urlMixin_url,
                analystic: this.analysticMixin_analystic,
                seo: this.seoMixin_seo
            };
        },
        pageContent() {
            let vBasicThemeVO = new VBasicThemeVO(
                this.avatarMixin_avatar,
                this.userTitleMixin_userTitle,
                this.descriptionMixin_description,
                this.linkItemListMixin_listMain,
                this.linkItemListMixin_list,
                this.socialLinksMixin_list,
                this.layoutMixin_layout,
                this.customdDataMixin_customData,
                this.urlMixin_url
            );
            return vBasicThemeVO.getRsp();
        },
    },
    methods: {
        async getAvailableLayouts() {
            try {
                let res = await vLayoutApi.getAvailableLayouts('VBasic');
                this.availableLayouts = res.data;
            } catch (err) {
                console.log(err);
                this.availableLayouts = [];
            }
        },
    },
    created() {
        // get layout
        this.getAvailableLayouts();

        // set default
        this.avatarMixin_newAvatarUrl("");
        this.userTitleMixin_newTitle("", "");
        this.descriptionMixin_newText("");
        this.linkItemListMixin_newListMain([]);
        this.linkItemListMixin_newList([]);
        this.socialLinksMixin_newList([]);
        this.layoutMixin_newLayout("leaf", "leaf");

        /** @param  {BackgroundVO} backgroundVO */
        this.customdDataMixin_setBackground({
            customBgOn: false,
            bgType: '',
            bgName: '',
            bgImage: '',
            bgColor: '',
            bgColor2: ''
        });
        this.customdDataMixin_setLinkButton({
            buttonName: '',
            buttonBorder: '',
            buttonRadius: '',
            buttonBgColor: '',
            buttonTextColor: ''
        });
        this.customdDataMixin_setText("");
        this.customdDataMixin_newCustomData();
        this.urlMixin_newUrl('');
        this.analysticMixin_newAnalystic('', '');
        this.seoMixin_newSeo('', '');

        // vBasicPageApi.getPageDataOri(pageId).then(rs => {
        //     console.log(rs.data);
        // });

        // vBasicPageApi.getPageContent().then((rs) => {
        vBasicPageApi.getPageDataOri(this.$store.state.pageId).then((rs) => {

            let data = rs.data;
            // console.log(data);
            this.avatarMixin_setAvatarUrl(data.avatar.avatarUrl);
            this.userTitleMixin_setTitle(data.userTitle.title, data.userTitle.title);
            this.descriptionMixin_setText(data.description.text);
            this.linkItemListMixin_setListMain(data.linkItemList.listMain);
            this.linkItemListMixin_setList(data.linkItemList.list);
            this.socialLinksMixin_setList(data.socialLinkList.list);
            this.layoutMixin_setLayout(data.layout.layoutName, data.layout.layoutCode);
            this.customdDataMixin_setBackground({
                customBgOn: data.customData.background.customBgOn,
                bgType: data.customData.background.bgType,
                bgName: data.customData.background.bgName,
                bgImage: data.customData.background.bgImage,
                bgColor: data.customData.background.bgColor,
                bgColor2: data.customData.background.bgColor2
            });

            this.customdDataMixin_setLinkButton({
                buttonName: data.customData.linkButton.buttonName,
                buttonBorder: data.customData.linkButton.buttonBorder,
                buttonRadius: data.customData.linkButton.buttonRadius,
                buttonBgColor: data.customData.linkButton.buttonBgColor,
                buttonTextColor: data.customData.linkButton.buttonTextColor
            });
            this.customdDataMixin_setText(data.customData.text.textColor);
            this.customdDataMixin_setCustomData();

            this.urlMixin_setUrl(data.pageData.pageUrl);
            this.analysticMixin_setAnalystic(data.analystic.gaId, data.analystic.fbPx);
            this.seoMixin_setSeo(data.seo.seoTitle, data.seo.seoDesc);

            this.$store.commit('setPageUrl', data.pageData.pageUrl)
            this.$store.commit('setPermissions', data.permissions)
            this.$store.commit('setPageOriApiLoaded')
        });
    },
    mounted() {
        // console.log(this.pageContent);
    },
};
</script>
<style lang="scss" scoped>
.my-h-screen {
    height: calc(100vh - 4rem);
}
</style>
