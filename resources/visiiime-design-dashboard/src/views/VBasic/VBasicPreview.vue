<template>
    <div>
        <v-basic-theme :theme-content="pageContent" />
    </div>
</template>

<script>
import VBasicTheme from "@/components/themes/VBasic/VBasicTheme";

import AvatarMixin from "@/mixins/VBasic/profile/AvatarMixin";
import UserTitleMixin from "@/mixins/VBasic/profile/UserTitleMixin";
import DescriptionMixin from "@/mixins/VBasic/profile/DescriptionMixin";
import LinkItemListMixin from "@/mixins/VBasic/linkItemList/LinkItemListMixin";
import SocialLinksMixin from "@/mixins/VBasic/socialLinks/SocialLinksMixin";
import LayoutMixin from "@/mixins/VBasic/layout/LayoutMixin";
import CustomDataMixin from "@/mixins/VBasic/customData/CustomDataMixin";

import VBasicThemeVO from "@/vo/theme/VBasicThemeVO";
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";

export default {
    components: {
        VBasicTheme,
    },
    mixins: [AvatarMixin, UserTitleMixin, DescriptionMixin, LinkItemListMixin, SocialLinksMixin, LayoutMixin, CustomDataMixin],
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
                this.customdDataMixin_customData
            );
            return vBasicThemeVO.getRsp();
        },
    },
    created() {
        // get layout
        // this.getAvailableLayouts();

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
            buttonName: "",
            buttonBorder: "",
            buttonRadius: "",
            buttonBgColor: "",
            buttonTextColor: "",
        });
        this.customdDataMixin_setText("");
        this.customdDataMixin_newCustomData();

        vBasicPageApi.getPageDataOri(this.$store.state.pageId).then((rs) => {
            let data = rs.data;
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
                buttonTextColor: data.customData.linkButton.buttonTextColor,
            });
            this.customdDataMixin_setText(data.customData.text.textColor);
            this.customdDataMixin_setCustomData();
        });
    },
};
</script>
<style lang="scss"></style>
