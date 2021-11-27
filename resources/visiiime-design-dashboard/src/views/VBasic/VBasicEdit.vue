<template>
    <div class="pt-5">
        <div class="flex-none mb-8">
            <avatar :avatar="originalContent.avatar" />
            <div class="align-center w-full">
                <a :href="pageUrl" target="_blank" class="link text-center w-full block">@{{ vPageUrl }}</a>
            </div>
        </div>
        <div class="mb-10">
            <profile
                :user-title="originalContent.userTitle"
                :description="originalContent.description"
            />
        </div>


        <div class="mb-10">
            <link-item-list
                :link-item-list="originalContent.linkItemListMain"
                :list-title="'精選連結'"
                :link-area="linkAreaEnum.main"
                @add-link-item="addLinkItem"
            />
        </div>


        <div class="mb-10">
            <link-item-list
                :link-item-list="originalContent.linkItemList"
                :list-title="'一般連結'"
                :link-area="linkAreaEnum.normal"
                @add-link-item="addLinkItem"
            />
        </div>

        <div class="mb-7">
            <link-item-list
                :link-item-list="originalContent.linkItemListSocial"
                :list-title="'社群媒體連結區'"
                :link-area="linkAreaEnum.social"
                @add-link-item="addLinkItem"
            />
        </div>
    </div>
</template>

<script>
import { linkType as linkTypeEnum, linkArea as linkAreaEnum} from "@/enum/vo/LinkItemEnum";

import Avatar from "@/components/design/profile/Avatar";
import UserTitle from "@/components/design/profile/UserTitle";
import Description from "@/components/design/profile/Description";
import Profile from "@/components/design/profile/Profile";
import LinkItemList from "@/components/design/linkItemList/LinkItemList";
import SocialLinks from "@/components/design/socialLinks/SocialLinks";

import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";
import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";

import { baseUrl as url } from "@/helper/env"


export default {
    data() {
        return {
            linkTypeEnum,
            linkAreaEnum,
        };
    },
    props: {
        originalContent: {
            type: Object,
            required: true,
        },
    },
    components: {
        Avatar,
        UserTitle,
        Description,
        Profile,
        LinkItemList,
        SocialLinks
    },
    computed: {
        baseUrl() {
            return url();
        },
        vPageUrl() {
            return this.$store.state.pageUrl;
        },
        pageUrl() {
            return this.baseUrl + '/' + this.vPageUrl;
        }
    },
    methods: {
        addLinkItem({ linkType, linkArea, id }) {
            const linkItem = new LinkItemVO();
            linkItem.id = id;
            linkItem.linkType = linkType;
            linkItem.linkArea = linkArea;

            switch (linkType) {
                case this.linkTypeEnum.media:
                    linkItem.mediaOpenType = "EXT";
                    linkItem.mediaName = "youtube";
                    break;
                case this.linkTypeEnum.collector:
                    linkItem.collector.collectTitle = "";
                    linkItem.collector.collectType = "email";
                    linkItem.collector.collectRsp = "";
                    break;
                default:
                    break;
            }

            if(linkArea === this.linkAreaEnum.main) {
                this.originalContent.linkItemListMain.list.push(linkItem);
            } else if (linkArea === this.linkAreaEnum.social) {
                this.originalContent.linkItemListSocial.list.push(linkItem);
            } else {
                this.originalContent.linkItemList.list.push(linkItem);
            }
        },
    },
    mounted() {

    }
};
</script>
