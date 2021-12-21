<template>
    <modal
        name="VIconSelectModal"
        :max-width="600" width="90%" height="auto" :adaptive="true"
        @before-open="beforeOpen"
    >
        <div class="max-h-96 overflow-y-scroll">
            <div class="mx-auto bg-white rounded-lg overflow-hidden">
                <div class="p-5">
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div v-for="(iconName, idx) in brandIconsSvg" :key="idx">
                            <div @click="changeImage(iconName)" class="border rounded p-2 cursor-pointer">
                                <div class="text-3xl text-center">
                                    <vs-icon 
                                        :icon-name="iconName" 
                                        class="flex justify-center items-center"
                                        :svg-size="32"
                                        :style="{margin: '0 auto'}"
                                    />
                                </div>
                                <div class="text-xs text-center">
                                    {{ iconDisplayName(iconName) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </modal>
</template>

<script>

import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";
import svgIcons from "./VIconsSvg";

import VsIcon from "../../icon/VsIcon.vue";

export default {
    data() {
        return {
            brandIconsSvg: svgIcons,
            idx: {
                type: Number,
                required: true
            }
        }
    },
    components: {
        VsIcon,
    },
    props: {
        originalContent: {
            type: Object,
            required: true
        }
    },
    computed: {
        linkItems() {
            return [
                ...this.originalContent.linkItemListMain.list,
                ...this.originalContent.linkItemList.list,
            ]
        }
    },
    methods: {
        beforeOpen({ params }) {
            this.linkItemId = params.linkItemId;
        },
        iconDisplayName(iconName) {

            let iconNameStr = iconName;
            let iconNameArr = iconNameStr.split('-');
            let newIconName = '';

            iconNameArr.forEach((item, idx) => {
                if(idx !== 0) {
                    newIconName += `${item} `;
                }
            });

            return newIconName;

        },
        changeImage(iconName) {

            this.$modal.hide('VIconSelectModal')

            let find = this.linkItems.find(item => {
                return item.id === this.linkItemId
            })

            vBasicLinkItemApi.linkItemUpdate({
                id: find.id,
                field: 'thumbnail',
                data: iconName,
            }).then(rs => {

                find.thumbnail = iconName
                this.$modal.show('result-modal', {
                    header: '上傳成功'
                })

            }).catch(error => {

                console.log(error)
                this.$modal.show('result-modal', {
                    header: '發生錯誤'
                })
            })
        }
    },
}
</script>
