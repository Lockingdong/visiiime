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
        <div class="text-right mb-5">
            <v-button @click="saveProfile()"> 儲存 </v-button>
        </div>

        <div class="mb-5">
            <!-- <link-add-button
                @add-link-item="addLinkItem"
                :link-limit="linkLimit"
                :link-count="linkCount"
            /> -->
        </div>

        <div class="mb-7">
            <link-item-list
                :link-item-list="originalContent.linkItemListMain"
                :list-title="'主要連結'"
                :delete-links="mainDelete"
                :link-area="linkAreaEnum.main"
                @add-link-item="addLinkItem"
            />
            <div class="text-right" v-show="originalContent.linkItemListMain.list.length !== 0">
                <v-button @click="saveLinks('main')"> 儲存 </v-button>
            </div>
        </div>


        <div class="mb-7">
            <link-item-list
                :link-item-list="originalContent.linkItemList"
                :list-title="'連結區'"
                :delete-links="normalDelete"
                :link-area="linkAreaEnum.normal"
                @add-link-item="addLinkItem"
            />
            <div class="text-right" v-show="originalContent.linkItemList.list.length !== 0">
                <v-button @click="saveLinks('normal')"> 儲存 </v-button>
            </div>
        </div>

        <v-h3 class="mb-3">媒體連結</v-h3>
        <div class="rounded bg-white shadow p-2">
            <social-links :social-links="originalContent.socialLinks" />
            <div class="text-right" v-show="originalContent.socialLinks.list !== 0">
                <v-button @click="saveSocialLinks()"> 儲存 </v-button>
            </div>
        </div>
    </div>
</template>

<script>
import { linkType as linkTypeEnum, linkArea as linkAreaEnum} from "@/enum/vo/LinkItemEnum";

import Avatar from "@/components/design/profile/Avatar";
import UserTitle from "@/components/design/profile/UserTitle";
import Description from "@/components/design/profile/Description";
import LinkAddButton from "@/components/design/linkItemList/LinkAddButton";
import LinkItemList from "@/components/design/linkItemList/LinkItemList";
import SocialLinks from "@/components/design/socialLinks/SocialLinks";

import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";
import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";

export default {
    data() {
        return {
            linkTypeEnum,
            linkAreaEnum,
            mainDelete: [],
            normalDelete: []
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
        LinkAddButton,
        LinkItemList,
        SocialLinks,
    },
    computed: {
        linkLimit() {
            return {
                main: 3,
                normal: 10,
            }
        },
        linkCount() {
            return {
                main: this.originalContent.linkItemListMain.list.length,
                normal: this.originalContent.linkItemList.list.length,
            }
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
            } else {
                this.originalContent.linkItemList.list.push(linkItem);
            }
        },
        saveLinks(area) {

            let type;
            let deleteItems = [];
            switch (area) {
                case 'main':
                    type = 'linkItemListMain';
                    deleteItems = this.mainDelete;
                    break;
                case 'normal':
                    type = 'linkItemList';
                    deleteItems = this.normalDelete;
                    break;
            }

            vBasicLinkItemApi.linkItemsUpdate({
                pageId: this.$store.state.pageId,
                list: this.originalContent[type].list,
                deleteItems
            }).then(rs => {
                console.log(rs.data)

                this.originalContent[type].list.forEach((el, idx) => {
                    if(el.id === '' || el.id === null) {
                        console.log(rs.data.ids[idx]);
                        el.id = rs.data.ids[idx];
                    }
                });

            }).catch(error => {
                console.log(error)
            });
        },
        saveProfile() {
            vBasicPageApi.profileUpdate({
                page_id: this.$store.state.pageId,
                avatar: this.originalContent.avatar.avatarUrl,
                user_title: this.originalContent.userTitle.title,
                description: this.originalContent.description.text,
            }).then(() => {

                // todo

            }).catch(error => {
                console.log(error)
            });

        },
        saveSocialLinks() {
            vBasicPageApi.socialLinksUpdate({
                page_id: this.$store.state.pageId,
                list: this.originalContent.socialLinks.list
            }).then(() => {

                // todo

            }).catch(error => {
                console.log(error)
            });
        }
    },
    mounted() {

    }
};
</script>
