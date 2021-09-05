<template>
    <modal
        :name="'ImageTypeSelectModal'"
        :max-width="600"
        width="90%"
        height="auto"
        :adaptive="true"
        @before-open="beforeOpen"
    >
        <div @click="openSelectImageForm" class="card-body cursor-pointer">
            <h2 class="card-title">選擇 Visiiime 圖標</h2>
        </div>
        <div @click="openUploadImageForm" class="card-body cursor-pointer">
            <h2 class="card-title">上傳您的圖片</h2>
        </div>
    </modal>
</template>

<script>
export default {
    data() {
        return {
            linkItemId: {
                type: String,
                required: true
            },
        }
    },
    methods: {
        beforeOpen({ params }) {
            this.linkItemId = params.linkItemId;
        },
        openUploadImageForm() {
            this.$modal.hide('ImageTypeSelectModal')
            this.$modal.show("linkItem" + this.linkItemId);
        },
        openSelectImageForm() {
            this.$modal.hide('ImageTypeSelectModal')
            this.$modal.show('LinkImageSelectModal', {
                linkItemId: this.linkItemId
            });
        }
    }
}
</script>
