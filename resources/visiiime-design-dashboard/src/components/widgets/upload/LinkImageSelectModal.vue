<template>
    <modal
        name="LinkImageSelectModal"
        :max-width="600" width="90%" height="auto" :adaptive="true"
        @before-open="beforeOpen"
    >
        <div class="max-h-96 overflow-y-scroll">
            <div class="mx-auto bg-white rounded-lg overflow-hidden">
                <div class="p-5">
                    <div class="w-full grid grid-cols-3 gap-2">
                        <div v-for="(iconName, idx) in colorIcons" :key="idx">
                            <div @click="changeImage(iconName)" class="border rounded p-2 cursor-pointer">
                                <div class="text-3xl text-center">
                                    <div class="avatar">
                                        <div class="rounded-full w-14 h-14">
                                            <img :src="require(`@/assets/icons/png/color/brand/${iconName}.png`)">
                                        </div>
                                    </div>
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

import colorIcons from './LinkImageSelect'
import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";

export default {
    data() {
        return {
            colorIcons,
            linkItemId: {
                type: String,
                required: true
            }
        }
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

            this.$modal.hide('LinkImageSelectModal')

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
