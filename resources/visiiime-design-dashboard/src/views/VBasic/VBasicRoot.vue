<template>
  <div>
    <base-root>
      <template #router>
        <router-view 
          class="max-w-xl mx-auto"
          :original-content="originalContent"
          @remove-link-item="linkItemListMixin_removeLinkItem"
        />
      </template>

      <template #theme>
        <!-- <pre class="text-xs overflow-scroll h-full">
          {{ pageContent }}
          {{ originalContent }}
        </pre> -->
        <v-basic-theme 
          :theme-content="pageContent" 
          :is-demo="true"
        />
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

import VBasicThemeVO from "@/vo/theme/VBasicThemeVO";
import MobilePhone from "@/components/widgets/MobilePhone";
import VBasicTheme from "@/components/themes/VBasic/VBasicTheme";

import VBasicCustomDataVO from "@/vo/theme/customData/VBasic/VBasicCustomDataVO";

import BaseRoot from "../BaseRoot";
import getAvailableLayouts from "@/api/VBasic/getAvailableLayouts"

import VBasicPageApi from "@/api/VBasic/VBasicPageApi"


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
    CustomDataMixin
  ],
  data() {
    return {
      availableLayouts: [],
      customData: {
        type: VBasicCustomDataVO,
        required: true,
      },
      mbPhone: false
    }
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
        customData: this.customdDataMixin_customData
      }
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
  methods: {
    async getAvailableLayouts() {
      try {
        let res = await getAvailableLayouts();
        this.availableLayouts = res.data;
      } catch(err) {
        console.log(err)
        this.availableLayouts = [];
      }
    },
  },
  created() {

    // get layout
    this.getAvailableLayouts();

    // set default
    this.avatarMixin_newAvatarUrl('');
    this.userTitleMixin_newTitle("", "");
    this.descriptionMixin_newText("");
    this.linkItemListMixin_newListMain([]);
    this.linkItemListMixin_newList([]);
    this.socialLinksMixin_newList([]);
    this.layoutMixin_newLayout('leaf', 'layout1')
    this.customdDataMixin_setBackground(
      false,
      'none',
      'none',
      '',
      '#A463BF'
    );
    this.customdDataMixin_setLinkButton('')
    this.customdDataMixin_setText('#A463BF')
    this.customdDataMixin_newCustomData();

    VBasicPageApi.getPageContent().then(rs => {
      
      let data = rs.data;
      this.avatarMixin_setAvatarUrl(data.avatar.avatarUrl);
      this.userTitleMixin_setTitle(data.userTitle.title, data.userTitle.title);
      this.descriptionMixin_setText(data.description.text);
      this.linkItemListMixin_setListMain(data.linkItemList.listMain);
      this.linkItemListMixin_setList(data.linkItemList.list);
      this.socialLinksMixin_setList(data.socialLinkList.list);
      this.layoutMixin_setLayout(
        data.layout.layoutName,
        data.layout.layoutId
      )
      this.customdDataMixin_setBackground(
        data.customData.background.customBgOn,
        data.customData.background.bgType,
        data.customData.background.bgName,
        data.customData.background.bgContent,
        data.customData.background.bgColor
      )

      this.customdDataMixin_setLinkButton(data.customData.linkButton.buttonBame)
      this.customdDataMixin_setText(data.customData.text.textColor)
      this.customdDataMixin_setCustomData();

    })
  },
  mounted() {
    // console.log(this.pageContent);
    
  }
};
</script>
<style lang="scss" scoped>
.my-h-screen {
  height: calc(100vh - 4rem);
}

</style>
