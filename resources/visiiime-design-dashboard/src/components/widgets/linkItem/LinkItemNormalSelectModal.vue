<template>
    <modal
        :name="'LinkItemNormalSelectModal'"
        :max-width="600"
        width="90%"
        height="auto"
        :adaptive="true"
        @before-open="beforeOpen"
    >
        <div @click="addTitleLink" class="card-body cursor-pointer">
            <div class="card-title">
                <fai :icon="['fa', 'heading']" class="mr-2" />
                新增標題
            </div>
        </div>
        <div @click="addCol50Link" class="card-body cursor-pointer">
            <div class="card-title">
                <fai :icon="['fa', 'align-right']" class="mr-2" />
                新增短連結
            </div>
        </div>
        <div @click="addBigImgLink" class="card-body cursor-pointer">
            <div class="card-title">
                <fai :icon="['fa', 'image']" class="mr-2" />
                新增大圖連結
            </div>
        </div>
    </modal>
</template>

<script>
import { library } from '@fortawesome/fontawesome-svg-core'
import {
    faHeading,
    faImage,
    faAlignRight

} from '@fortawesome/free-solid-svg-icons'

library.add(
    faHeading,
    faImage,
    faAlignRight
)
export default {
    data() {
        return {
            
        }
    },
    methods: {
        beforeOpen({ params }) {
        },
        addCol50Link() {
            this.$emit('add-col-50-link')
            this.$modal.hide('LinkItemNormalSelectModal')
        },
        addBigImgLink() {
            this.$emit('add-big-img-link')
            this.$modal.hide('LinkItemNormalSelectModal')
        },
        addTitleLink() {
            this.$emit('add-title-link')
            this.$modal.hide('LinkItemNormalSelectModal')
        }
    }
}
</script>
