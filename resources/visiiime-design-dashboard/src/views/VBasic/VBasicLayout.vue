<template>
    <div class="layout">
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


    </div>
</template>

<script>
import LayoutSelect from "@/components/design/layout/LayoutSelect";
import CustomData from "@/components/design/layout/CustomData";

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
        CustomData
    },
    data() {
        return {
            showSave: false
        }
    },
    props: {
        originalContent: {
            type: Object,
            required: true,
        },
    },
    methods: {
        showSaveButton(bool) {
            this.showSave = bool
        }
    }
};
</script>
