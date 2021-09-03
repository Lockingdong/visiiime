<template>
    <div class="mb-3">
        <v-h3 class="mb-2">{{ listTitle }}</v-h3>
        <div class="btn-group flex mb-5">
            <button
                @click="mainAddLink()"
                :class="{loading: isLoading}"
                class="btn btn-md btn-primary flex-grow border-r border-gray-100"
            >新增連結</button>
            <button
                v-if="linkArea !== linkAreaEnum.social"
                @click="featureButtonOn = !featureButtonOn" class="btn btn-md flex-none btn-primary border-l border-gray-100 relative">
                <fai :icon="['fas', 'star']" size="lg" />
                <div
                    v-show="featureButtonOn"
                    role="menu"
                    aria-orientation="vertical"
                    aria-labelledby="user-menu-button"
                    tabindex="1"
                    class="z-10 origin-top-right absolute right-0 top-10 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none text-left"
                    style=""
                >
                    <!-- <div @click="addLinkItem(linkTypeEnum.main, 'main')" tabindex="-1" class="outline-none block px-4 py-2 text-sm text-gray-700">主連結</div> -->
                    <div @click="addLinkItem(linkArea, linkTypeEnum.media)" tabindex="-1" class="outline-none block px-4 py-2 text-sm text-gray-700">媒體連結</div>
                    <!-- <div @click="addLinkItem(linkTypeEnum.collector, 'normal')" tabindex="-1" class="outline-none block px-4 py-2 text-sm text-gray-700">collector link</div> -->
                </div>
            </button>
        </div>
        <draggable :list="linkItemList.list" handle=".handle">
            <link-item v-for="(linkItem, idx) in linkItemList.list" :key="linkItem.uuid" :link-item="linkItem" :idx="idx" @remove-link-item="removeLinkItem" />
        </draggable>
        <div class="text-right">
            <button
                v-show="showSave"
                @click="saveLinks()"
                :class="{loading: loading}"
                :disabled="loading"
                class="btn btn-primary"
            >儲存變更</button>
        </div>
    </div>
</template>

<script>
import helperMixin from "@/mixins/VBasic/HelperMixin";
import LinkItem from "@/components/design/linkItemList/LinkItem";
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import LinkItemListVO from "@/vo/design/linkItemList/LinkItemListVO";
import draggable from "vuedraggable";
import {
    linkType as linkTypeEnum,
    linkArea as linkAreaEnum
} from "@/enum/vo/LinkItemEnum";

import { library } from "@fortawesome/fontawesome-svg-core";
import { faImage } from "@fortawesome/free-regular-svg-icons";
import { faStar } from "@fortawesome/free-solid-svg-icons";

import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";

library.add(faImage, faStar);

export default {
    mixins: [
        helperMixin
    ],
    components: {
        LinkItem,
        draggable,
    },
    data() {
        return {
            loading: false,
            showSave: false,
            isLoading: false,
            featureButtonOn: false,
            linkTypeEnum,
            linkAreaEnum,
        };
    },
    props: {
        linkItemList: {
            type: LinkItemListVO,
            required: true,
        },
        listTitle: {
            type: String,
            required: true,
        },
        linkArea: {
            type: String,
            required: true
        }
    },
    computed: {
        apiLoaded() {
            return this.helperMixin_pageApiLoaded;
        },
        linkLimit() {
            return {
                [linkAreaEnum.main]: 3,
                [linkAreaEnum.normal]: 10,
                [linkAreaEnum.social]: 10,
            }
        },
        linkItemListStr() {
            return JSON.stringify(this.linkItemList);
        },
    },
    methods: {
        mainAddLink() {

            let curLinkArea = this.linkArea;

            let linkArea;
            let linkType;

            switch (curLinkArea) {
                case this.linkAreaEnum.main:
                    linkArea = this.linkAreaEnum.main;
                    linkType = this.linkTypeEnum.normal;
                    break;
                case this.linkAreaEnum.normal:
                    linkArea = this.linkAreaEnum.normal;
                    linkType = this.linkTypeEnum.normal;
                    break;
                case this.linkAreaEnum.social:
                    linkArea = this.linkAreaEnum.social;
                    linkType = this.linkTypeEnum.social;
                    break;
                default:
                    console.log('area type not found')
                    break;
            }

            this.addLinkItem(linkArea, linkType);

        },
        removeLinkItem(idx, id) {

            vBasicLinkItemApi.linkItemDelete({
                id,
            }).then(rs => {

                this.linkItemList.list.splice(idx, 1);

                this.$modal.show('result-modal', {
                    header: '刪除成功',
                });

            }).catch(err => {

                console.log(err)

                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: '請重新操作一次'
                });

            })
        },
        addLinkItem(linkArea, linkType) {

            if(this.linkItemList.list.length >= this.linkLimit[linkArea]) {

                this.$modal.show('result-modal', {
                    header: `連結限制為${this.linkLimit[linkArea]}個`,
                })
                return;
            }

            this.isLoading = true;

            vBasicLinkItemApi.linkItemCreate({
                page_id: this.$store.state.pageId,
                link_area: linkArea,
                link_type: linkType,
                link_order: this.linkItemList.list.length + 1
            }).then(rs => {

                this.$emit("add-link-item", {
                    linkType,
                    linkArea,
                    id: rs.data.id
                })

                this.isLoading = false;

            }).catch(err => {

                console.log(err)

                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: '請重新操作一次'
                });
                this.isLoading = false;

            })

        },
        saveLinks() {

            this.loading = true;

            let area = this.linkArea;
            let type;
            let deleteItems = [];
            switch (area) {
                case this.linkAreaEnum.main:
                    type = 'linkItemListMain';
                    break;
                case this.linkAreaEnum.normal:
                    type = 'linkItemList';
                    break;
                case this.linkAreaEnum.social:
                    type = 'linkItemListSocial';
                    break;
                default:
                    console.log(area + ' not found')
                    break;
            }

            vBasicLinkItemApi.linkItemsUpdate({
                pageId: this.$store.state.pageId,
                list: this.linkItemList.list,
                deleteItems
            }).then(rs => {

                this.loading = false;
                this.showSave = false;
                this.$modal.show('result-modal', {
                    header: '更新成功',
                })

            }).catch(err => {

                console.log(err)

                this.loading = false;
                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: err.response.data.data
                })
            });
        },
        watchLinkItemList() {
            if(this.apiLoaded) {
                this.$watch('linkItemListStr', (nv, ov) => {
                    this.showSave = true;
                }, {deep: true});
            }
        },
    },
    watch: {
        apiLoaded(nv, ov) {
            if(nv) {
                setTimeout(() => {
                    this.watchLinkItemList();
                }, 1000)

            }
        }
    },
    mounted() {
        this.watchLinkItemList();
    }
};
</script>
