<template>
    <div>
        <v-ob ref="vob">
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
            async validate() {

                try {

                    let rs = await this.$refs.vob.validate()

                    this.profile.userTitle.valid = rs;
                    
                } catch (error) {

                    console.log(error)
                    
                    this.profile.userTitle.valid = false;
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
    .my-text {
        min-height: 50px;
    }
</style>
