<template>
    <div class="card shadow-md mb-3">
        <div class="bg-white rounded shadow">
            <div class="w-full flex px-2">
                <div class="handle flex justify-center align-middle border-r pr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-gray-500 fill-current cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                </div>
                <div class="flex-grow">
                    <component
                        ref="linkItem"
                        :is="linkItemComponent"
                        :link-item="linkItem"
                        :idx="idx"
                        @thumbnail-required="openImageDashBoard"
                        @link-item-update="linkItemUpdate"
                    />
                    <div class="p-2 text-gray-400">
                        <template v-if="linkItem.linkType !== linkTypeEnum.title">
                            <div v-if="isLinkAreaAllowDashboard('Image')" :class="{'text-primary': displayImageAlert}" class="t indicator mr-5">
                                <fai @click="toggleDashboard('Image')" :icon="['fa', 'image']" :class="{'text-xl': currentDashboard === 'Image'}" class="cursor-pointer"/>
                            </div>
                            <div v-if="isLinkAreaAllowDashboard('Display')" :class="{'text-primary': false}" class="indicator mr-5">
                                <fai @click="toggleDashboard('Display')" :icon="['fa', 'magic']" :class="{'text-xl': currentDashboard === 'Display'}" class="cursor-pointer"/>
                            </div>
                            <div v-if="isLinkAreaAllowDashboard('Calendar')" :class="{'text-primary': displayCalendarAlert}" class="indicator mr-5">
                                <fai @click="toggleDashboard('Calendar')" :icon="['fa', 'calendar-alt']" :class="{'text-xl': currentDashboard === 'Calendar'}" class="cursor-pointer" />
                            </div>
                            <div v-if="isLinkAreaAllowDashboard('Star')" :class="{'text-primary': displayStarAlert}" class="indicator mr-5">
                                <fai @click="toggleDashboard('Star')" :icon="['fa', 'rocket']" :class="{'text-xl': currentDashboard === 'Star'}" class="cursor-pointer" />
                            </div>
                            <div v-if="isLinkAreaAllowDashboard('Lock')" :class="{'text-primary': displayLockAlert}" class="indicator mr-5">
                                <fai  @click="toggleDashboard('Lock')" :icon="['fa', 'lock']" :class="{'text-xl': currentDashboard === 'Lock'}" class="cursor-pointer" />
                            </div>
                            <div v-if="isLinkAreaAllowDashboard('Chart')" :class="{'text-primary': false}" class="indicator mr-5">
                                <fai @click="toggleDashboard('Chart')" :icon="['fa', 'chart-line']" :class="{'text-xl': currentDashboard === 'Chart'}" class="cursor-pointer" />
                            </div>
                        </template>
                    </div>
                </div>
                <div class="flex-col flex justify-between items-center pl-2 py-3">
                    <!-- <label class="cursor-pointer label pt-0">
                        <input v-model="linkItem.online" type="checkbox" checked="checked" class="toggle toggle-accent toggle-sm">
                    </label> -->
                    <simple-switch 
                        ref="switch"
                        class="inline-block"
                        style="margin-top: -10px"
                        :value="linkItem.online"
                        :size="'sm'"
                        :custom-click="true"
                        @switch-clicked="validateLinkItem"
                        @confirm="setLinkItemOnline"
                    />
                    <fai @click="openRemoveLinkItemModal" :icon="['fa', 'trash-alt']" class="cursor-pointer text-red-400"/>
                </div>
            </div>
            <div class="relative">
                <fai
                    @click="currentDashboard = ''"
                    v-show="currentDashboard !== ''"
                    :icon="['fa', 'times']"
                    class="absolute top-2 right-2 text-white cursor-pointer"/>
                <component
                    :is="linkDashboardComponent"
                    :link-item="linkItem"
                    :idx="idx"
                    @link-item-update="linkItemUpdate"
                />
            </div>
        </div>
        <confirm-modal
            :modal-name="confirmModalName"
            @confirm="removeLinkItem"
        />
    </div>
</template>

<script>
import { library } from '@fortawesome/fontawesome-svg-core'
import {
    faImage,
    faMagic,
    faCalendarAlt,
    faRocket,
    faTrashAlt,
    faChartLine,
    faPhotoVideo,
    faTimes,
    faLock
} from '@fortawesome/free-solid-svg-icons'
library.add(
    faImage,
    faMagic,
    faCalendarAlt,
    faRocket,
    faTrashAlt,
    faChartLine,
    faPhotoVideo,
    faTimes,
    faLock
)

import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";

import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import { ValidationProvider as VP } from "vee-validate";
import { confirmSetting } from "@/helper/alertSetting";

import photoIcon from "@/components/icon/Photo";
import calendarIcon from "@/components/icon/Calendar";
import starIcon from "@/components/icon/Star";

import { debounce } from 'vue-debounce'

import {
    linkType as linkTypeEnum,
    linkArea as linkAreaEnum
} from "@/enum/vo/LinkItemEnum";

import SimpleSwitch from "@/components/widgets/switch/SimpleSwitch"
import ConfirmModal from "@/components/widgets/upload/ConfirmModal";

export default {
    data() {
        return {
            online: false,
            photoOpen: false,
            currentDashboard: "",
            dashboard: [
                'Image',
                'Display',
                'Calendar',
                'Star',
                'Chart',
                'Lock'
            ],
            linkAreaEnum,
            linkTypeEnum
        };
    },
    components: {
        VP,
        photoIcon,
        calendarIcon,
        starIcon,
        SimpleSwitch,
        ConfirmModal
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
        confirmModalName() {
            return 'confirmModalNameRemove' + this.linkItem.id
        },
        linkItemComponent() {
            console.log(this.linkItem.linkType)
            let linkType = this.linkItem.linkType.toLowerCase();
            const LinkType = linkType.charAt(0).toUpperCase() + linkType.slice(1);

            if(LinkType === 'Media') {
                return () => import(`./linkItem/LinkItemNormal`);
            }

            return () => import(`./linkItem/LinkItem${LinkType}`);
        },
        linkDashboardComponent() {
            if (this.currentDashboard !== "" && this.dashboard.includes(this.currentDashboard)) {
                return () => import(`./linkDashboard/LinkDashboard${this.currentDashboard}.vue`);
            }
            return () => import(`./linkDashboard/LinkDashboardDefault.vue`);
        },
        linkAreaAllowedDashboard() {
            return {
                [this.linkAreaEnum.main]: ['Image', 'Calendar', 'Star', 'Chart', 'Lock'],
                [this.linkAreaEnum.normal]: ['Image', 'Calendar', 'Star', 'Chart', 'Lock'],
                [this.linkAreaEnum.social]: ['Chart'],
            }
        },
        displayImageAlert() {
            return !['', null].includes(this.linkItem.thumbnail)
        },
        displayCalendarAlert() {
            return this.linkItem.startAt !== null && this.linkItem.endAt
        },
        displayStarAlert() {
            if(this.linkItem.linkCustomData === null) {
                return false
            }

            return !['', null].includes(this.linkItem.linkCustomData.linkAnimation)
        },
        displayLockAlert() {
            return !['', null].includes(this.linkItem.linkPwd)
        }
    },
    methods: {
        openRemoveLinkItemModal() {
            this.$modal.show(this.confirmModalName, {
                header: '您確定要刪除嗎？ 此動作無法復原。',
            });
        },
        removeLinkItem() {
            this.$emit("remove-link-item", this.idx, this.linkItem.id);
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
        },
        setLinkItemOnline(bool) {

            vBasicLinkItemApi.linkItemContentUpdate({
                id: this.linkItem.id,
                link_name: this.linkItem.linkName,
                link: this.linkItem.link,
                valid: this.linkItem.valid,
                online: bool,
                link_type: this.linkItem.linkType,
                media_open_type: this.linkItem.mediaOpenType
            }).then(rs => {

                this.linkItem.online = bool

            }).catch(err => {

                console.log(err.response.data.data)

                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                })

            })
        },
        isLinkAreaAllowDashboard(dashboard) {
            return this.linkAreaAllowedDashboard[this.linkItem.linkArea].find(el => el === dashboard) !== undefined;
        },
        async validateLinkItem() {

            let rs = await this.$refs.linkItem.validate();
            this.linkItem.valid = rs

            if(rs) {
                this.$refs.switch.showModal()
            }

            console.log(rs)
        }
    },
};
</script>

<style lang="scss" scoped>
.translate-x-full {
    --tw-translate-x: 100%;
}

.bg-gray-200 {
    --tw-bg-opacity: 1;
    background-color: rgba(229, 229, 229, var(--tw-bg-opacity));
}

.bg-green-500 {
    --tw-bg-opacity: 1;
    background-color: rgba(16, 185, 129, var(--tw-bg-opacity));
}
    // input:checked ~ .dot {
    //     transform: translateX(100%);
    //     background-color: #6ddf9d;
    // }

    // .main-orange {
    //     color: #ff5864;
    // }

    // .main-orange-bg {
    //     background-color: #ff5864;
    // }
</style>
