<template>
    <div>
        <v-ob ref="vob">
            <!-- <div v-show="!titleEditable" class="flex justify-start align-middle">
                <div class="text-gray-600">{{ title }}</div>
                <svg @click="titleEditClick" xmlns="http://www.w3.org/2000/svg" class="bottom-0 ml-2 h-5 w-5 text-gray-600 fill-current cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                </svg>
            </div> -->
            <div class="block">
                <v-p v-slot="{ errors }" rules="required|max:15" name="標題" tag="div" class="form-control">
                    <label class="label">
                        <span class="label-text">標題</span>
                    </label>
                    <input
                        v-model="profile.userTitle.title"
                        :class="{'input-error': errors.length !== 0}"
                        type="text"
                        placeholder="請輸入標題"
                        class="input input-sm input-bordered"
                    >
                    <div>
                        <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                    </div>

                </v-p>
            </div>
        </v-ob>
    </div>
</template>

<script>
    import { ValidationProvider as VP } from "vee-validate";
    import vBasicPageApi from "@/api/VBasic/VBasicPageApi";

    export default {
        data() {
            return {
                titleEditable: true,
            };
        },
        components: {
            VP,
        },
        props: {
            profile: {
                type: Object,
                required: true,
            },
        },
        computed: {
            title() {
                if (this.profile.userTitle.title === "") {
                    return this.profile.userTitle.defaultTitle;
                }

                return this.profile.userTitle.title;
            },
        },
        methods: {
            titleEditClick() {
                this.titleEditable = !this.titleEditable;
                this.$nextTick(() => {
                    this.$refs.titleInput.focus();
                });
            },
            validate() {
                this.$refs.vob.validate()
                    .then(rs => {
                        this.profile.userTitle.valid = rs;
                    }).catch(err => {
                        this.profile.userTitle.valid = false;
                    })
            },
        },
        watch: {
            profile: {
                handler() {
                    this.validate();
                },
                deep: true
            }
        },
        mounted() {
            this.validate();
        },
    };
</script>

<style lang="scss">
    .my-text {
        min-height: 50px;
    }
</style>
