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
            <div class="card-title">
                <fai :icon="['fas', 'icons']" class="mr-2" />
                選擇Icon
            </div>
        </div>
        <div v-if="iconType" @click="openSelectImageForm" class="card-body cursor-pointer">
            <div class="card-title">
                <fai :icon="['fa', 'copyright']" class="mr-2" />
                選擇圖標
            </div>
        </div>
        <div v-if="imgType" @click="openUploadImageForm" class="card-body cursor-pointer">
            <div class="card-title">
                <fai :icon="['fa', 'file-image']" class="mr-2" />
                上傳您的圖片 <div class="badge badge-primary">BETA</div>
            </div>
        </div>
    </modal>
</template>

<script>
import { library } from '@fortawesome/fontawesome-svg-core'
import {
    faIcons,
    faCopyright,
    faFileImage
} from '@fortawesome/free-solid-svg-icons'
// import {
//     faIcons,
// } from '@fortawesome/free-brands-svg-icons'

library.add(
    faIcons,
    faCopyright,
    faFileImage
)
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
