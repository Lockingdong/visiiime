<template>
    <div class="setting">
        <url :url="originalContent.url" />
        <analystic :analystic="originalContent.analystic" />
        <seo :seo="originalContent.seo" />
    </div>
</template>

<script>
import Url from "@/components/design/setting/Url";
import Analystic from "@/components/design/setting/Analystic";
import Seo from "@/components/design/setting/Seo";

export default {
    components: {
        Url,
        Analystic,
        Seo
    },
    props: {
        originalContent: {
            type: Object,
            required: true,
        },
    },

};
</script>
