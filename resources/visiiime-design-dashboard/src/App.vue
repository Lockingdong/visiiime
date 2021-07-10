<template>
    <div id="app">
        <navbar />
        <router-view />
    </div>
</template>

<script>
import { isProd } from "@/helper/env";
import Navbar from "@/components/Navbar";

export default {
    components: {
        Navbar,
    },
    created() {
        let pageId;
        if (isProd()) {
            pageId = window.page_id || "";
        } else {
            pageId = this.$route.query.page_id || "";
        }
        this.$store.commit('setPageId', pageId)
    },
};
</script>
<style></style>
