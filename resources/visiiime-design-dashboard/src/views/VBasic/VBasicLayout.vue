<template>
    <div class="layout">
        <layout-select
            :original-content="originalContent"
        />
        <custom-data
            :original-content="originalContent"
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
    props: {
        originalContent: {
            type: Object,
            required: true,
        },
    },
};
</script>
