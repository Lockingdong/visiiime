<template>
    <div class="card shadow-md mb-3 bg-white py-3 px-4">
        <template v-if="apiLoaded">
            <user-title :profile="profile" @show-save-button="showSaveButton" />
            <description :profile="profile" @show-save-button="showSaveButton" />
            <div class="text-right">
                <button
                    v-show="showSave"
                    @click="saveProfile()"
                    :class="{loading: loading}"
                    :disabled="loading || !valid"
                    class="btn btn-primary"
                >儲存變更</button>
            </div>
        </template>
    </div>
</template>
<script>
import helperMixin from "@/mixins/VBasic/HelperMixin";
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";
import UserTitle from "@/components/design/profile/UserTitle";
import Description from "@/components/design/profile/Description";
import DescriptionVO from "@/vo/design/profile/DescriptionVO";
import UserTitleVO from "@/vo/design/profile/UserTitleVO";
export default {
    mixins: [
        helperMixin
    ],
    data() {
        return {
            loading: false,
            showSave: false,
        }
    },
    components: {
        UserTitle,
        Description,
    },
    props: {
        description: {
            type: DescriptionVO,
            required: true,
        },
        userTitle: {
            type: UserTitleVO,
            required: true,
        },
    },
    computed: {
        apiLoaded() {
            return this.helperMixin_pageApiLoaded;
        },
        profile() {
            return {
                description: this.description,
                userTitle: this.userTitle
            }
        },
        valid() {
            return this.description.valid && this.userTitle.valid;
        }
    },
    methods: {
        async saveProfile() {
            

            try {

                this.loading = true;

                await vBasicPageApi.profileUpdate({
                    page_id: this.$store.state.pageId,
                    user_title: this.userTitle.title,
                    description: this.description.text,
                });

                this.loading = false;
                this.showSave = false;
                this.$modal.show('result-modal', {
                    header: '更新成功',
                })
                
            } catch (error) {

                console.log(error)
                this.loading = false;
                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: error.response.data.data
                })
                
            }


            // vBasicPageApi.profileUpdate({
            //     page_id: this.$store.state.pageId,
            //     user_title: this.userTitle.title,
            //     description: this.description.text,
            // }).then(() => {

            //     this.loading = false;
            //     this.showSave = false;
            //     this.$modal.show('result-modal', {
            //         header: '更新成功',
            //     })

            // }).catch(err => {
            //     console.log(err)
            //     this.loading = false;
            //     this.$modal.show('result-modal', {
            //         header: '發生錯誤',
            //         content: err.response.data.data
            //     })
            // });

        },
        showSaveButton() {
            this.showSave = true
        }
    },
    watch: {
    },
    mounted() {
    }
}
</script>
