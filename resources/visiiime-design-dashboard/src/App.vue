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

        if(pageId === '' && process.env.VUE_APP_PAGE_ID !== undefined) {
            document.location.href = '/?page_id=' + process.env.VUE_APP_PAGE_ID;
        }
        if(pageId === '') {
            console.error(pageId + ' page id not found')
        }

        this.$store.commit('setPageId', pageId)
    },
};
</script>
<style>
.vm--modal {
    border-radius: 1rem !important;
}

.border-error {
    border: 2px solid;
    border-color: hsla(var(--er)/var(--tw-border-opacity,1));
}

* {
    /* letter-spacing: 1px; */
}
</style>
