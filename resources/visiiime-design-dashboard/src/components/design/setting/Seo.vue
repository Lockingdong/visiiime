<template>
    <v-ob
        tag="div"
        class="mb-10"
        ref="vob"
        >
        <div class="text-2xl mb-3">SEO 設定</div>
        <div :class="{'border-error': serverError}" class="card shadow-md mb-3 p-3 bg-white relative">
            <v-p
                v-slot="{ errors }"
                name="網頁標題"
                rules="max:15|min:3"
                tag="div"
            >
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">網頁標題</span>
                    </label>
                    <input
                        @keyup="input"
                        :class="{'input-error': errors.length !== 0}"
                        v-model="seo.seoTitle" type="text" placeholder="網頁標題" class="input input-bordered w-full">
                    <div>
                        <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                    </div>
                </div>
            </v-p>
            <v-p
                v-slot="{ errors }"
                name="網頁描述"
                rules="min:3|max:200"
                tag="div"
            >
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">網頁描述</span>
                    </label>
                    <textarea
                        @keyup="input"
                        :class="{'input-error': errors.length !== 0}"
                        v-model="seo.seoDesc"
                        class="textarea h-24 textarea-bordered w-full" placeholder="網頁描述"
                    ></textarea>
                    <div>
                        <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                    </div>
                </div>

            </v-p>
            <div class="justify-end card-actions">
                <button
                    v-show="showSave"
                    :class="{loading: loading}"
                    @click="submit"
                    :disabled="loading || !valid"
                    class="btn btn-primary"
                >儲存</button>
            </div>
        </div>

        <result-modal
            :modal-name="modalData.name"
            :header="modalData.header"
            :content="modalData.content"
        />
    </v-ob>
</template>

<script>
import { ValidationProvider as VP } from 'vee-validate'

import SeoVO from "@/vo/design/setting/SeoVO";
import ResultModal from "@/components/widgets/upload/ResultModal";
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";


export default {
    components: {
        VP,
        ResultModal
    },
    props: {
        seo: {
            type: SeoVO,
            required: true
        }
    },
    data() {
        return {
            valid: false,
            serverError: false,
            loading: false,
            showSave: false,
            modalData: {
                name: 'seo-result',
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
                vBasicPageApi.pageSeoUpdate({
                    page_id: this.$store.state.pageId,
                    seo_title: this.seo.seoTitle,
                    seo_desc: this.seo.seoDesc
                }).then(() => {
                    this.loading = false;
                    this.serverError = false;
                    this.modalData.header = '更新成功';
                    this.modalData.content = '';
                    this.showSave = false;
                    this.$modal.show(this.modalData.name)

                }).catch(err => {
                    this.loading = false;
                    this.serverError = true;
                    this.modalData.header = '發生錯誤';
                    this.modalData.content = err.response.data.data;
                    this.$modal.show(this.modalData.name)
                });
            }
        },
        input(){
            this.validate().then(rs => {
                this.valid = rs
            });
            this.serverError = false;
            this.showSave = true;
        }
    },
    mounted() {
        this.validate();
    }
}
</script>
