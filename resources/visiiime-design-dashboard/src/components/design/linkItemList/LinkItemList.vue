<template>
    <div class="mb-3">
        <div class="text-xl mb-2"><fai :icon="titleIcon" size="sm" /> {{ listTitle }}</div>
        <div class="flex mb-5">
            <button
                @click="mainAddLink()"
                :class="{loading: isLoading}"
                class="btn btn-md btn-primary flex-grow border-r border-gray-100"
            >新增連結</button>
            <div v-if="linkArea === linkAreaEnum.normal" class="dropdown dropdown-end">
                <div @click="openLinkItemNormalSelectModal()" tabindex="0" class="ml-1 btn btn-primary">
                    <fai :icon="['fas', 'star']" size="lg" />    
                </div> 
                
                <link-item-normal-select-modal 
                    @add-title-link="addTitleLink()"
                    @add-big-img-link="addBigImgLink()"
                    @add-col-50-link="addCol50Link()"
                />
            </div>
        </div>
        <draggable :list="linkItemList.list" handle=".handle" @change="moved()">
            <link-item v-for="(linkItem, idx) in linkItemList.list" :key="linkItem.uuid" :link-item="linkItem" :idx="idx" @remove-link-item="removeLinkItem" />
        </draggable>
        <div v-if="showSave" class="text-center">
            <button
                @click="saveLinks()"
                :class="{loading: loading}"
                :disabled="loading"
                class="btn btn-primary"
            >更新連結順序</button>
        </div>
    </div>
</template>

<script>
import helperMixin from "@/mixins/VBasic/HelperMixin";
import LinkItem from "@/components/design/linkItemList/LinkItem";
import LinkItemNormalSelectModal from "@/components/widgets/linkItem/LinkItemNormalSelectModal";
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
import { faImage, faStar as farStar} from "@fortawesome/free-regular-svg-icons";
import { faStar, faBahai, faShareAlt } from "@fortawesome/free-solid-svg-icons";

import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";
import { CAN_USE_LINK_ITEM_COUNT } from "@/enum/permission/vBasic/VPermission";
import { current } from 'daisyui/colors';

library.add(
    faImage, 
    faStar,
    faBahai,
    farStar,
    faShareAlt
);

export default {
    mixins: [
        helperMixin
    ],
    components: {
        LinkItem,
        draggable,
        LinkItemNormalSelectModal
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
        },
        titleIcon: {
            type: Array,
            required: true
        }
    },
    computed: {
        permission() {
            return this.$store.getters.getPermission(CAN_USE_LINK_ITEM_COUNT);
        },
        apiLoaded() {
            return this.helperMixin_pageApiLoaded;
        },
        linkLimit() {
            return {
                [linkAreaEnum.main]: this.permission[linkAreaEnum.main],
                [linkAreaEnum.normal]: this.permission[linkAreaEnum.normal],
                [linkAreaEnum.social]: this.permission[linkAreaEnum.social],
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
        bigImgLinkCount() {
            return this.linkItemList.list.reduce((acc, current) => {
                if(current.linkImgMode === this.linkImageMode.big) {
                    return acc + 1;
                }
                return acc + 0;
            }, 0)
        }
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

            if(this.bigImgLinkCount >= this.permission[this.linkImageMode.big]) {
                this.$modal.show('result-modal', {
                    header: `大圖連結限制為${this.permission[this.linkImageMode.big]}個`,
                })
                return;
            }

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
        // watchLinkItemList() {
        //     if(this.apiLoaded) {
        //         this.$watch('linkItemListOrderStr', (nv, ov) => {
        //             this.showSave = true;
        //         }, {deep: true});
        //     }
        // },
        openLinkItemNormalSelectModal() {
            this.$modal.show('LinkItemNormalSelectModal')
        },
        moved() {
            if(this.linkItemList.list.length === 0) {
                return
            }
            this.showSave = true;
        }
    },
    watch: {
        // apiLoaded(nv, ov) {
        //     if(nv) {
        //         setTimeout(() => {
        //             this.watchLinkItemList();
        //         }, 1000)

        //     }
        // }
    },
    mounted() {
        // this.watchLinkItemList();
    }
};
</script>
