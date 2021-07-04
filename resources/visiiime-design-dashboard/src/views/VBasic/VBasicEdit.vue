<template>
  <div class="pt-5">
    <div class="flex">
      <div class="flex-none">
        <avatar :avatar="originalContent.avatar" />
      </div>
      <div class="flex-grow p-6">
        <div class="mb-3">
          <user-title :user-title="originalContent.userTitle" />
        </div>
        <description :description="originalContent.description" />
      </div>
    </div>

    <div>
      <link-add-button 
        @add-link-item="addLinkItem"
      />
    </div>

    <div class="mb-7">
      <link-item-list
        :link-item-list="originalContent.linkItemListMain"
        :list-title="'main links'"
        :link-limit="3"
        @remove-link-item="removeLinkItem"
      />
    </div>
    
    <div class="mb-7">
      <link-item-list
        :link-item-list="originalContent.linkItemList"
        :list-title="'normal links'"
        :link-limit="10"
        @remove-link-item="removeLinkItem"
      />
    </div>
    
    <!-- <div>
      {{originalContent.socialLinks}}
    </div> -->
    <div class="text-xl mb-3">Social Links</div>
    <div class="rounded bg-white shadow p-2">

      <social-links 
        :social-links="originalContent.socialLinks"
      />
      <!-- <div v-for="(item, idx) in originalContent.socialLinks.list" :key="idx" class="flex">
        <div class="">
          <fai :icon="{ prefix: 'fab', iconName: 'facebook' }" />
          <fai :icon="{ prefix: 'fab', iconName: 'line' }" />
        </div>
        <div class="">
          {{ ' ' + item.link }}
        </div>
      </div> -->
    </div>
  </div>
</template>

<script>
import { linkType as linkTypeEnum } from '@/enum/vo/LinkItemEnum'

import Avatar from "@/components/design/profile/Avatar";
import UserTitle from "@/components/design/profile/UserTitle";
import Description from "@/components/design/profile/Description";
import LinkAddButton from "@/components/design/linkItemList/LinkAddButton";
import LinkItemList from "@/components/design/linkItemList/LinkItemList";
import SocialLinks from "@/components/design/socialLinks/SocialLinks";

import LinkItemVO from '@/vo/design/linkItemList/LinkItemVO';


export default {
  data() {
    return {
      linkTypeEnum
    }
  },
  props: {
    originalContent: {
      type: Object,
      required: true,
    }
  },
  components: {
    Avatar,
    UserTitle,
    Description,
    LinkAddButton,
    LinkItemList,
    SocialLinks
  },
  methods: {
    removeLinkItem(uid) {
      this.$emit('remove-link-item', uid)
    },
    addLinkItem(linkType) {

      const linkItem = new LinkItemVO();
      linkItem.linkType = linkType;
      switch (linkType) {
        case this.linkTypeEnum.main:
          this.originalContent.linkItemListMain.list.push(linkItem)
          break;
        case this.linkTypeEnum.media:
          linkItem.mediaOpenType = "EXT";
          linkItem.mediaName = "youtube";
          this.originalContent.linkItemList.list.push(linkItem)
          break;
        case this.linkTypeEnum.collector:
          linkItem.collector.collectTitle = "";
          linkItem.collector.collectType = "email";
          linkItem.collector.collectRsp = "";
          this.originalContent.linkItemList.list.push(linkItem)
          break;
        default:
          this.originalContent.linkItemList.list.push(linkItem)
          break;
      }
    }
  }
}
</script>
