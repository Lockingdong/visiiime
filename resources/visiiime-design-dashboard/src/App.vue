<template>
    <div id="app">
        <navbar />
        <router-view />
    </div>
</template>

<script>
import { queryString } from "@/helper/queryString";
import Navbar from "@/components/Navbar";

export default {
    components: {
        Navbar,
    },
    created() {
        // console.log(queryString())
        let pageId = queryString().page_id || "";
        this.$store.commit('setPageId', pageId)
    },
};
</script>
<style></style>
