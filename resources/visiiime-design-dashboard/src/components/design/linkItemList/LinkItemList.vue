<template>
    <div class="mb-3">
        <v-h3 class="mb-2">{{ listTitle }}</v-h3>
        <div class="btn-group flex mb-5">
            <button
                v-if="linkArea === linkAreaEnum.main"
                @click="addLinkItem(linkArea, linkTypeEnum.main)"
                :class="{loading: isLoading}"
                class="btn btn-md btn-primary flex-grow border-r border-gray-100"
            >新增連結</button>
            <button
                v-else
                @click="addLinkItem(linkArea, linkTypeEnum.normal)"
                :class="{loading: isLoading}"
                class="btn btn-md btn-primary flex-grow border-r border-gray-100"
            >新增連結</button>
            <button class="btn btn-md flex-none btn-primary border-l border-gray-100">
                <fai :icon="['fas', 'star']" size="lg" />
            </button>
        </div>
        <draggable :list="linkItemList.list" handle=".handle">
            <link-item v-for="(linkItem, idx) in linkItemList.list" :key="linkItem.uuid" :link-item="linkItem" :idx="idx" @remove-link-item="removeLinkItem" />
        </draggable>
    </div>
</template>

<script>
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
    components: {
        LinkItem,
        draggable,
    },
    data() {
        return {
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
        deleteLinks: {
            type: Array,
            required: true
        },
        linkArea: {
            type: String,
            required: true
        }
    },
    computed: {
        linkLimit() {
            return {
                [linkAreaEnum.main]: 3,
                [linkAreaEnum.normal]: 10,
            }
        },
    },
    methods: {
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
    },
};
</script>
