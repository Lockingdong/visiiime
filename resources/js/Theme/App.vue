<template>
    <div id="app">
        <v-basic-theme :theme-content="pageContent" />
    </div>
</template>
<script>
import VBasicTheme from "../../visiiime-design-dashboard/src/components/themes/VBasic/VBasicTheme";

export default {
    data() {
        return {
            pageContent: window.pageContent
        };
    },
    components: {
        VBasicTheme,
    },
    mounted() {
        // console.log(this.pageContent.CUSD.background);
    }
};
</script>
<style lang="scss">
* {
    box-sizing: border-box;
    border-width: 0;
}
html,
body {
    margin: 0;
    padding: 0;
}
a {
    color: inherit;
    text-decoration: inherit;
}
ul {
    list-style: none;
    padding: 0;
    margin-block-start: 1em;
    margin-block-end: 1em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    padding-inline-start: 40px;
}
</style>
