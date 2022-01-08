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
            async validate() {

                try {

                    let rs = await this.$refs.vob.validate()

                    this.profile.description.valid = rs;
                    
                } catch (error) {

                    console.log(error)
                    
                    this.profile.description.valid = false;
                }
            },
        },
        async mounted() {

            this.$watch('profile', () => {
                
                this.$emit('show-save-button')

                this.validate();

            }, {deep: true});
        },
    };
</script>

<style lang="scss">
    // .my-text {
    //   // min-height: 50px;
    // }
</style>
