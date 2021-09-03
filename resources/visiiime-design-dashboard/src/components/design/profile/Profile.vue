<template>
    <div class="card shadow-md mb-3 bg-white py-3 px-4">
        <user-title :profile="profile" />
        <description :profile="profile" />
        <div class="text-right">
            <button
                v-show="showSave"
                @click="saveProfile()"
                :class="{loading: loading}"
                :disabled="loading || !valid"
                class="btn btn-primary"
            >儲存變更</button>
        </div>
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
        saveProfile() {
            this.loading = true;
            vBasicPageApi.profileUpdate({
                page_id: this.$store.state.pageId,
                user_title: this.userTitle.title,
                description: this.description.text,
            }).then(() => {

                this.loading = false;
                this.showSave = false;
                this.$modal.show('result-modal', {
                    header: '更新成功',
                })

            }).catch(err => {
                console.log(err)
                this.loading = false;
                this.$modal.show('result-modal', {
                    header: '發生錯誤',
                    content: err.response.data.data
                })
            });

        },
        watchProfile() {
            if(this.apiLoaded) {
                this.$watch('profile', () => {
                    this.showSave = true;
                }, {deep: true});
            }
        }
    },
    watch: {
        apiLoaded(nv) {
            if(nv) {
                this.watchProfile();
            }
        }
    },
    mounted() {
        this.watchProfile();
    }
}
</script>
