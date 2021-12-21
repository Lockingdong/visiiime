<template>
    <div class="mb-3">
        <v-h3 class="mb-2">{{ listTitle }}</v-h3>
        <div class="flex mb-5">
            <button
                @click="mainAddLink()"
                :class="{loading: isLoading}"
                class="btn btn-md btn-primary flex-grow border-r border-gray-100"
            >新增連結</button>
            <div v-if="linkArea === linkAreaEnum.normal" class="dropdown dropdown-end">
                <div tabindex="0" class="ml-1 btn btn-primary">
                    <fai :icon="['fas', 'star']" size="lg" />    
                </div> 
                <ul tabindex="0" class="p-2 shadow-lg menu dropdown-content bg-base-100 rounded-box w-52">
                    <li>
                        <div @click="addTitleLink" class="p-2 cursor-pointer">新增標題</div>
                    </li>
                    <li>
                        <div @click="addBigImgLink" class="p-2 cursor-pointer">新增大圖連結</div>
                    </li>
                    <li>
                        <div @click="addCol50Link" class="p-2 cursor-pointer">新增短連結</div>
                    </li> 
                </ul>
            </div>
        </div>
        <draggable :list="linkItemList.list" handle=".handle">
            <link-item v-for="(linkItem, idx) in linkItemList.list" :key="linkItem.uuid" :link-item="linkItem" :idx="idx" @remove-link-item="removeLinkItem" />
        </draggable>
        <div class="text-center">
            <button
                v-show="showSave"
                @click="saveLinks()"
                :class="{loading: loading}"
                :disabled="loading"
                class="btn btn-primary"
            >變更連結順序</button>
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
    linkArea as linkAreaEnum,
    linkImageMode,
    linkColMode
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
            linkImageMode,
            linkColMode
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
        linkItemListOrder() {
            return this.linkItemList.list.map(item => {
                return {
                    linkOrder: item.linkOrder
                }
            })
        },
        linkItemListOrderStr() {
            return JSON.stringify(this.linkItemListOrder);
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
        addTitleLink() {
            this.addLinkItem(
                this.linkAreaEnum.normal, 
                this.linkTypeEnum.title
            );
        },
        addBigImgLink() {

            // todo check permissions
            this.addLinkItem(
                this.linkAreaEnum.normal, 
                this.linkTypeEnum.normal,
                {
                    link_img_mode: this.linkImageMode.big
                }
            );
            
        },
        addCol50Link() {

            // todo check permissions
            this.addLinkItem(
                this.linkAreaEnum.normal, 
                this.linkTypeEnum.normal,
                {
                    link_col_mode: this.linkColMode.c50
                }
            );
            
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
        addLinkItem(linkArea, linkType, extraFields = {}) {

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
                link_order: this.linkItemList.list.length + 1,
                extraFields
            }).then(rs => {

                // console.log(rs.data)

                this.$emit("add-link-item", {
                    linkType,
                    linkArea,
                    id: rs.data.id,
                    extraFieldsObj: rs.data.extraFields
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
                this.$watch('linkItemListOrderStr', (nv, ov) => {
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
