<template>
    <div class="setting">
        <normal-alert v-if="!hasPermission"></normal-alert>
        <div class="mt-2">
            <!-- <url :url="originalContent.url" /> -->
            <analystic :analystic="originalContent.analystic" />
            <delete v-if="$store.state.pageDefault === 'N'" />
            
            <!-- <seo :seo="originalContent.seo" /> -->
        </div>
    </div>
</template>

<script>
import Url from "@/components/design/setting/Url";
import Analystic from "@/components/design/setting/Analystic";
import Seo from "@/components/design/setting/Seo";
import Delete from "@/components/design/setting/Delete";
import NormalAlert from "@/components/widgets/permission/NormalAlert";
import { CAN_USE_EDIT_SETTING } from "@/enum/permission/vBasic/VPermission";

export default {
    components: {
        Url,
        Analystic,
        Seo,
        NormalAlert,
        Delete
    },
    props: {
        originalContent: {
            type: Object,
            required: true,
        },
    },
    computed: {
        hasPermission() {
            return this.$store.getters.hasPermission(CAN_USE_EDIT_SETTING);
        },
    },

};
</script>
