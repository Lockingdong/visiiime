<template>
    <div class="mb-3">
        <v-ob ref="vob">
            <div v-show="textEditable" class="block">
                <v-p v-slot="{ errors }" rules="max:100" name="簡介" tag="div" class="form-control">
                    <label class="label">
                        <span class="label-text">簡介</span>
                    </label>
                    <textarea :class="{'input-error': errors.length !== 0}" ref="textInput" class="textarea h-24 textarea-bordered" rows="3" placeholder="簡介" v-model="profile.description.text"></textarea>
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
                textEditable: true,
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
            text() {
                if (this.profile.description.text === "") {
                    return "請輸入您的簡介...";
                }

                return this.profile.description.text;
            },
        },
        methods: {
            textEditClick() {
                this.textEditable = !this.textEditable;
                this.$nextTick(() => {
                    this.$refs.textInput.focus();
                });
            },
            validate() {

                this.$refs.vob.validate()
                    .then(rs => {
                        this.profile.description.valid = rs;
                    }).catch(err => {
                        this.profile.description.valid = false;
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
            this.validate()
        },
    };
</script>

<style lang="scss">
    // .my-text {
    //   // min-height: 50px;
    // }
</style>
