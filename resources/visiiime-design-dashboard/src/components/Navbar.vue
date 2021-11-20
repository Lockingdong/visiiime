<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <nav v-show="isPreviewPage" class="bg-white">
        <div class="mx-auto px-2 md:px-6 lg:px-8 border border-b-1 md:border-0 shadow-sm">
            <div class="relative flex items-center justify-between h-16 shadow-sm z-1">
                <div class="absolute inset-y-0 left-0 flex items-center md:hidden">
                    <!-- Mobile menu button-->
                    <button
                        type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu"
                        aria-expanded="false"
                    >
                        <span class="sr-only">Open main menu</span>

                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-center md:items-stretch md:justify-start">
                    <a href="/v-dashboard" class="flex-shrink-0 flex items-center">
                        <img class="block h-8 w-auto" src="@/assets/logo.png" alt="Workflow" />
                    </a>
                    <div class="hidden md:block md:ml-6">
                        <div class="flex space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <router-link
                                v-for="link in displayLinks"
                                :key="link.routeName"
                                class="text-gray-700 px-5 py-2 text-sm font-medium h-16 flex justify-center items-center"
                                :class="getCurrentRouteClass(link.routeName)"
                                :to="{ name: link.routeName }"
                                :target="link.routeName === 'VPreview' ? '_blank' : '_self'"
                            >
                                {{ link.linkName }}
                            </router-link>

                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 md:static md:inset-auto md:ml-6 md:pr-0">
                    <div class="p-1 flex justify-items-center">
                        
                        <simple-switch 
                            class=" hidden md:block"
                            :value="$store.state.online"
                            @confirm="setPageOnline"
                        />
                    </div>
                    
                    <!-- <button class="bg-gray-800 p-1 rounded-full text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                        <span class="sr-only">View notifications</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                            />
                        </svg>
                    </button> -->

                    <!-- Profile dropdown -->
                    <div class="ml-3 relative">
                        <div>
                            <button
                                @click="dropdownMenu = !dropdownMenu"
                                type="button"
                                class="bg-indigo-700 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-800 focus:ring-white"
                                id="user-menu-button"
                                aria-expanded="false"
                                aria-haspopup="true"
                            >
                                <span class="sr-only">Open user menu</span>
                                <img class="h-8 w-8 rounded-full" :src="baseUrl + '/VBasic/avatar-icon.png'" alt />
                            </button>
                        </div>

                        <div
                            v-show="dropdownMenu"
                            class="z-10 origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            role="menu"
                            aria-orientation="vertical"
                            aria-labelledby="user-menu-button"
                            tabindex="-1"
                        >
                            <!-- Active: "bg-gray-100", Not Active: "" -->
                            <a href="/v-dashboard" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">回管理後台</a>
                            <span @click="logoutUser" class="block px-4 py-2 text-sm text-gray-700 cursor-pointer" role="menuitem" tabindex="-1" id="user-menu-item-2">登出</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div class="md:hidden" id="mobile-menu">
            <div class="px-2 pt-2 space-y-1 flex justify-between">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->

                <div>
                    <router-link
                        v-for="link in displayLinks"
                        :key="link.routeName"
                        class="text-gray-600 inline-block px-3 py-2 text-base font-medium"
                        :class="getCurrentRouteClass(link.routeName)"
                        :to="{ name: link.routeName }"
                        :target="link.routeName === 'VPreview' ? '_blank' : '_self'"
                    >
                        {{ link.linkName }}
                    </router-link>
                    <a :href="pageUrl" class="text-gray-600 inline-block px-3 py-2 text-base underline font-light" target="blank">{{ vPageUri }}</a>
                </div>
                <simple-switch 
                    class="inline-block"
                    :value="$store.state.online"
                    @confirm="setPageOnline"
                />
            </div>
        </div>
    </nav>
</template>

<script>
import { isProd, baseUrl as url } from '@/helper/env'
import ConfirmModal from "@/components/widgets/upload/ConfirmModal";
import SimpleSwitch from "@/components/widgets/switch/SimpleSwitch"

import vBasicPageApi from "@/api/VBasic/VBasicPageApi";
import userApi from "@/api/VBasic/UserApi";

export default {
    components: {
        ConfirmModal,
        SimpleSwitch
    },
    data() {
        return {
            links: [
                {
                    linkName: "頁面編輯",
                    routeName: "VEdit",
                },
                {
                    linkName: "主題風格",
                    routeName: "VLayout",
                },
                {
                    linkName: "設定",
                    routeName: "VSetting",
                },
                {
                    linkName: "數據分析",
                    routeName: "VAnalysis",
                },
                {
                    linkName: "VPreview",
                    routeName: "VPreview",
                },
                {
                    linkName: "Tpl",
                    routeName: "VTpl",
                },
            ],
            dropdownMenu: false,
        };
    },
    computed: {
        isPreviewPage() {
            return this.$route.name !== "VPreview";
        },
        pageId() {
            return this.$store.state.pageId;
        },
        displayLinks() {
            return this.links.filter(item => {
                if(isProd()) {

                    return item.routeName !== 'VPreview' &&
                            item.routeName !== 'VTpl'
                } else {
                    return item;
                }
            })

        },
        baseUrl() {
            return url();
        },
        vPageUri() {
            return this.$store.state.pageUrl;
        },
        pageUrl() {
            return this.baseUrl + '/' + this.vPageUri;
        },
    },
    methods: {
        getCurrentRouteClass(name) {
            if (name === this.$route.name) {
                return "border-b-2 border-purple-500 active";
            }
            return "";
        },
        setPageOnline(bool) {

            if(!this.$store.state.userVerified) {
                this.$modal.show('result-modal', {
                    header: '請先通過 Email 認證再進行發布'
                })
                return
            }

            vBasicPageApi.pageOnlineUpdate({
                page_id: this.$store.state.pageId,
                online: + bool
            })
            .then(rs => {
                this.$store.commit('setOnline', bool)

                this.$modal.show('result-modal', {
                    header: '更新成功'
                })
            })
            .catch(err => {
                console.log(err)
                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: err.response.data.data
                })
            })
        },
        logoutUser() {
            userApi.logoutUser()
                .then(rs => {
                    window.location.href = '/'
                })
                .catch(err => {
                    window.location.href = '/'
                })
        }
    },
};
</script>
