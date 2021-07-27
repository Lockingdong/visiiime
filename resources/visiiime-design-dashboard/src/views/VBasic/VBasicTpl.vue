<template>
    <div>
        <v-h1>這是Heading1</v-h1>
        <v-h2>這是Heading1</v-h2>
        <v-h3>這是Heading1</v-h3>
        <v-h4>這是Heading1</v-h4>
        <v-h5>這是Heading1</v-h5>
        <v-h6>這是Heading1</v-h6>
        <v-alert variant="danger" show> 發生錯誤 </v-alert>
        <v-alert variant="success" show> 成功資訊 </v-alert>
        <v-button>這是按鈕</v-button>
        <v-button variant="secondary">這是按鈕</v-button>
        <v-button variant="success">這是按鈕</v-button>
        <v-button variant="error">這是按鈕</v-button>
        <v-button variant="link">這是按鈕</v-button>
        <div>
            <v-toggle></v-toggle>
            <v-toggle variant="success"></v-toggle>
            <v-toggle variant="danger"></v-toggle>
            <v-toggle variant="box"></v-toggle>
            <v-tag tag-name="div" variant="title">普通標題</v-tag>
            <v-tag tag-name="div" variant="subtitle">普通標題</v-tag>
            <v-tag tag-name="div" variant="badge">錯誤訊息</v-tag>
            <v-tag tag-name="div" variant="avatar">
                <img src="http://administrator.dongstudio.live/storage/uploads/images/visiiime/_1626931000_gSgVTCNhRhpH.png" alt="">
            </v-tag>
            <v-select :options="[
                { value: 1, text: 'Option 1' },
                { value: 2, text: 'Option 2' },
                { value: 3, text: 'Option 3', disabled: true }
                ]"
            />
            <div class="flex">
                <label class="flex items-center">
                    <v-radio name="options" value="a" checked />
                    <span class="ml-2 text-sm">Option A</span>
                </label>
                <label class="flex items-center ml-2">
                    <v-radio name="options" value="b" />
                    <span class="ml-2 text-sm">Option B</span>
                </label>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    mounted() {
        // console.log(components)
    }
}
</script>
