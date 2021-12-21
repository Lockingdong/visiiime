<template>
    <modal
        :name="'ImageTypeSelectModal'"
        :max-width="600"
        width="90%"
        height="auto"
        :adaptive="true"
        @before-open="beforeOpen"
    >
        <div v-if="svgType" @click="openSelectVIconForm" class="card-body cursor-pointer">
            <h2 class="card-title">選擇 Visiiime Icon {{svgType}}</h2>
        </div>
        <div v-if="iconType" @click="openSelectImageForm" class="card-body cursor-pointer">
            <h2 class="card-title">選擇 Visiiime 圖標</h2>
        </div>
        <div v-if="imgType" @click="openUploadImageForm" class="card-body cursor-pointer">
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
            svgType: {
                type: Boolean,
                required: true,
                default: false,
            },
            iconType: {
                type: Boolean,
                required: true
            },
            imgType: {
                type: Boolean,
                required: true
            },
        }
    },
    methods: {
        beforeOpen({ params }) {
            this.linkItemId = params.linkItemId;
            this.svgType = params.svgType !== undefined ? params.svgType : true;
            this.iconType = params.iconType !== undefined ? params.svgType : true;
            this.imgType = params.imgType !== undefined ? params.svgType : true;
        },
        openUploadImageForm() {
            this.$modal.hide('ImageTypeSelectModal');
            this.$modal.show("linkItem" + this.linkItemId);
        },
        openSelectImageForm() {
            this.$modal.hide('ImageTypeSelectModal');
            this.$modal.show('LinkImageSelectModal', {
                linkItemId: this.linkItemId
            });
        },
        openSelectVIconForm() {
            this.$modal.hide('ImageTypeSelectModal');
            this.$modal.show('VIconSelectModal', {
                linkItemId: this.linkItemId
            });
        }
    }
}
</script>
