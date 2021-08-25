<template>
    <v-ob
        tag="div"
        class="mb-10"
        ref="vob"
        >
        <div class="text-2xl mb-3">網址設定</div>
        <v-p
            v-slot="{ errors }"
            :class="{'border-error': serverError}"
            class="card shadow-md mb-3 p-3 bg-white relative"
            name="路徑名稱"
            rules="required|max:20|min:3|alpha_num"
            tag="div"
        >
            <div class="form-control">
                <label class="label">
                    <span class="label-text">網址名稱</span>
                </label>
                <input
                    @input="input"
                    :class="{'input-error': errors.length !== 0}"
                    v-model="url.pageUri" type="text" placeholder="您的網址名稱" class="input input-bordered w-full">
                <div>
                    <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                </div>
            </div>
            <div class="justify-end card-actions">
                <button
                    v-show="showSave"
                    :class="{loading: loading}"
                    @click="submit"
                    :disabled="errors.length !== 0 || loading"
                    class="btn btn-primary"
                >儲存變更</button>
            </div>
        </v-p>
        <result-modal
            :modal-name="modalData.name"
            :header="modalData.header"
            :content="modalData.content"
        />
    </v-ob>
</template>

<script>
import ResultModal from "@/components/widgets/upload/ResultModal";

import { ValidationProvider as VP } from 'vee-validate'

import UrlVO from "@/vo/design/setting/UrlVO";
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";

export default {
    components: {
        VP,
        ResultModal
    },
    props: {
        url: {
            type: UrlVO,
            required: true
        }
    },
    data() {
        return {
            serverError: false,
            loading: false,
            showSave: false,
            modalData: {
                name: 'url-result',
                header: '',
                content: '',
            }
        }
    },
    methods: {
        async validate() {
            return await this.$refs.vob.validate();
        },
        async submit() {
            this.loading = true;

            const result = await this.validate();

            if(result) {
                await vBasicPageApi.pageUriUpdate({
                    page_id: this.$store.state.pageId,
                    page_url: this.url.pageUri
                }).then(() => {
                    this.loading = false;
                    this.serverError = false;
                    this.modalData.header = '更新成功';
                    this.modalData.content = '';
                    this.showSave = false;
                    this.$modal.show('url-result')

                }).catch(err => {
                    this.loading = false;
                    this.serverError = true;
                    this.modalData.header = '發生錯誤';
                    this.modalData.content = err.response.data.data;
                    this.$modal.show('url-result')
                });
            }
        },
        input(){
            this.serverError = false;
            this.showSave = true;
        }
    },
    mounted() {
        this.validate();
    }
}
</script>
