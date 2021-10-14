<template>
    <div>
        <base-root>
            <template #router>
                <div v-if="!$store.state.userVerified" class="max-w-xl mx-auto bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 rounded mb-2 text-sm">
                    <p class="font-bold">您的帳號尚未認證</p>
                    <p>請前往您的信箱查看驗證信 <span @click="resendVerifyEmail" class="underline cursor-pointer">重發驗證信</span></p>
                </div>
                <keep-alive>
                    <router-view class="max-w-xl mx-auto" :original-content="originalContent" @remove-link-item="linkItemListMixin_removeLinkItem" />
                </keep-alive>
            </template>

            <template #theme>
                <!-- <pre class="text-xs overflow-scroll h-full">
                    {{ pageContent }}
                </pre> -->
                <!-- <pre class="text-xs overflow-scroll h-full">{{ originalContent }}</pre> -->
                <v-basic-theme :theme-content="pageContent" :is-demo="true" />
            </template>
        </base-root>
        <result-modal
            :modal-name="'result-modal'"
        />
        <social-link-icon-select-modal
            :link-item-list-social="originalContent.linkItemListSocial"
        />
        <image-type-select-modal />
        <link-image-select-modal
            :original-content="originalContent"
        />
    </div>
</template>

<script>
import AvatarMixin from "@/mixins/VBasic/profile/AvatarMixin";
import UserTitleMixin from "@/mixins/VBasic/profile/UserTitleMixin";
import DescriptionMixin from "@/mixins/VBasic/profile/DescriptionMixin";
import LinkItemListMixin from "@/mixins/VBasic/linkItemList/LinkItemListMixin";
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
import userApi from "@/api/VBasic/UserApi";

import { csrfToken } from "@/helper/env";

import ResultModal from "@/components/widgets/upload/ResultModal";
import SocialLinkIconSelectModal from "@/components/widgets/social/SocialLinkIconSelectModal";
import ImageTypeSelectModal from "@/components/widgets/upload/ImageTypeSelectModal";
import LinkImageSelectModal from "@/components/widgets/upload/LinkImageSelectModal";


export default {
    name: "VBasic",
    components: {
        MobilePhone,
        VBasicTheme,
        BaseRoot,
        ResultModal,
        SocialLinkIconSelectModal,
        ImageTypeSelectModal,
        LinkImageSelectModal
    },
    mixins: [
        AvatarMixin,
        UserTitleMixin,
        DescriptionMixin,
        LinkItemListMixin,
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
                linkItemListSocial: this.linkItemListMixin_listSocial,
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
                this.linkItemListMixin_listSocial,
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
        resendVerifyEmail() {

            userApi.verifyEmail({
                _token: csrfToken()
            }).then(rs => {

                this.$modal.show('result-modal', {
                    header: '發送成功',
                })

            }).catch(err => {

                if(err.response.status === 429) {
                    this.$modal.show('result-modal', {
                        header: '已發送，請稍後再試',
                    })
                }

                this.$modal.show('result-modal', {
                    header: '發生錯誤，請稍後再試',
                })
            })

        }
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
        this.linkItemListMixin_newListSocial([]);
        this.layoutMixin_newLayout("snow", "snow");

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
            this.linkItemListMixin_setListSocial(data.linkItemList.listSocial);
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

            this.$store.commit('setOnline', !!data.vPage.online)
            this.$store.commit('setUserVerified', data.user.isVerified)
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
