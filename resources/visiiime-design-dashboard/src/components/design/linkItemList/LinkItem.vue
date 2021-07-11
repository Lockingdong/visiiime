<template>
    <div class="mb-3">
        <div class="bg-white rounded shadow">
            <div class="w-full flex px-2">
                <div class="handle flex justify-center align-middle border-r pr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-gray-500 fill-current cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                </div>
                <div class="flex-grow">
                    <component
                        :is="linkItemComponent"
                        :link-item="linkItem"
                        :idx="idx"
                        @thumbnail-required="openImageDashBoard"
                        @link-item-update="linkItemUpdate"
                    />
                    <div class="p-2">
                        <vicon @click.native="toggleDashboard('Image')" icon="photo" class="w-8 h-8 mr-2" />
                        <vicon @click.native="toggleDashboard('Calendar')" icon="calendar" class="w-8 h-8 mr-2" />
                        <vicon @click.native="toggleDashboard('Star')" icon="star" class="w-8 h-8 mr-2" />
                    </div>
                </div>
                <div class="flex-col flex justify-between pl-2 py-2">
                    <label :for="'toogle' + linkItem.linkType + idx" class="flex items-center cursor-pointer">
                        <div class="relative">
                            <input :id="'toogle' + linkItem.linkType + idx" v-model="linkItem.online" type="checkbox" class="sr-only" />
                            <div class="w-6 h-3 bg-gray-100 rounded-full shadow-inner"></div>
                            <div class="dot absolute w-3 h-3 bg-white rounded-full shadow -left-0 top-0 transition"></div>
                        </div>
                    </label>
                    <svg @click="removeLinkItem" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-300 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
            </div>
            <component
                :is="linkDashboardComponent"
                :link-item="linkItem"
                :idx="idx"
                @link-item-update="linkItemUpdate"
            />
        </div>
    </div>
</template>

<script>
import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";
import uploadImageModal from "@/components/widgets/upload/UploadSingleImageModal";

import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import { ValidationProvider as VP } from "vee-validate";
import { confirmSetting } from "@/helper/alertSetting";

import photoIcon from "@/components/icon/Photo";
import calendarIcon from "@/components/icon/Calendar";
import starIcon from "@/components/icon/Star";

import { debounce } from 'vue-debounce'

export default {
    data() {
        return {
            photoOpen: false,
            currentDashboard: "",
            dashboard: ["Image", "Calendar", "Star"],
        };
    },
    components: {
        VP,
        uploadImageModal,
        photoIcon,
        calendarIcon,
        starIcon,
    },
    props: {
        linkItem: {
            type: LinkItemVO,
            required: true,
        },
        idx: {
            type: Number,
            required: true,
        },
    },
    computed: {
        linkItemComponent() {
            let linkType = this.linkItem.linkType.toLowerCase();
            const LinkType = linkType.charAt(0).toUpperCase() + linkType.slice(1);
            return () => import(`./linkItem/LinkItem${LinkType}`);
        },
        linkDashboardComponent() {
            if (this.currentDashboard !== "" && this.dashboard.includes(this.currentDashboard)) {
                return () => import(`./linkDashboard/LinkDashboard${this.currentDashboard}.vue`);
            }
            return () => import(`./linkDashboard/LinkDashboardDefault.vue`);
        },
    },
    methods: {
        removeLinkItem() {
            this.$swal({
                ...confirmSetting,
                text: "確定要刪除嗎",
            }).then((result) => {
                if (result.isConfirmed) {
                    this.$emit("remove-link-item", this.idx, this.linkItem.id);
                }
            });
        },
        toggleDashboard(dashboard) {
            if (dashboard === this.currentDashboard) {
                this.currentDashboard = "";
                return;
            }
            this.currentDashboard = dashboard;
        },
        openImageDashBoard(errorMsg) {
            this.currentDashboard = "Image";
        },
        linkItemUpdate({field, data}) {

            debounce((field, data) => {
                vBasicLinkItemApi.linkItemUpdate({
                    id: this.linkItem.id,
                    field,
                    data,
                }).then(rs => {

                }).catch(error => {
                    alert('發生錯誤')
                })
            }, 1000)(field, data)
        }
    },
};
</script>

<style lang="scss" scoped>
    input:checked ~ .dot {
        transform: translateX(100%);
        background-color: #6ddf9d;
    }

    .main-orange {
        color: #ff5864;
    }

    .main-orange-bg {
        background-color: #ff5864;
    }
</style>
