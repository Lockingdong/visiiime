<template>
    <div class="mb-3">
        <div class="text-lg mb-2">{{ listTitle }}</div>
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
import { linkType as linkTypeEnum } from "@/enum/vo/LinkItemEnum";

import { library } from "@fortawesome/fontawesome-svg-core";
import { faImage } from "@fortawesome/free-regular-svg-icons";
import { faStar } from "@fortawesome/free-solid-svg-icons";
library.add(faImage, faStar);

export default {
    components: {
        LinkItem,
        draggable,
    },
    data() {
        return {
            featureButtonOn: false,
            linkTypeEnum,
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
        }
    },
    methods: {
        removeLinkItem(idx, id) {
            this.linkItemList.list.splice(idx, 1);
            if(id !== '') {
                this.deleteLinks.push(id);
            }
        },
    },
};
</script>
