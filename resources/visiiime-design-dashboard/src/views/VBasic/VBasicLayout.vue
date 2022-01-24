<template>
    <div class="layout relative">
        <layout-select
            @show-save-button="showSaveButton"
            :original-content="originalContent"
            :show-save="showSave"
        />
        <custom-data
            @show-save-button="showSaveButton"
            :original-content="originalContent"
            :show-save="showSave"
        />
        <!-- <custom-data-viewer
            :original-content="originalContent"
        /> -->
    </div>
</template>

<script>
import LayoutSelect from "@/components/design/layout/LayoutSelect";
import CustomData from "@/components/design/layout/CustomData";
import CustomDataViewer from "@/components/design/layout/CustomDataViewer";

import { CAN_USE_LAYOUT_CUSTOM_DATA } from "@/enum/permission/vBasic/VPermission";

import { library } from '@fortawesome/fontawesome-svg-core'
import {
    faLock,
} from '@fortawesome/free-solid-svg-icons'
library.add(
    faLock,
)

export default {
    components: {
        LayoutSelect,
        CustomData,
        CustomDataViewer,
    },
    data() {
        return {
            showSave: false,
        }
    },
    props: {
        originalContent: {
            type: Object,
            required: true,
        },
    },
    computed: {
        hasPermission() {
            return this.$store.getters.hasPermission(CAN_USE_LAYOUT_CUSTOM_DATA);
        },
    },
    methods: {
        showSaveButton(bool) {
            this.showSave = bool
        }
    }
};
</script>
