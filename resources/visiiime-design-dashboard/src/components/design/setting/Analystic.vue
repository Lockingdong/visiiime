<template>
    <v-ob
        tag="div"
        class="mb-10"
        ref="vob"
        >
        <div class="text-2xl mb-3">追蹤設定</div>
        <div :class="{'border-error': serverError}" class="card shadow-md mb-3 p-3 bg-white relative">
            <v-p
                v-slot="{ errors }"
                name="Google Analystic ID"
                rules="max:15|min:10|alpha_dash"
                tag="div"
            >
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Google Analystic ID</span>
                    </label>
                    <input
                        @keyup="input"
                        :class="{'input-error': errors.length !== 0}"
                        v-model="analystic.gaId" type="text" placeholder="UA-000000-2" class="input input-bordered w-full">
                    <div>
                        <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                    </div>
                </div>
            </v-p>
            <v-p
                v-slot="{ errors }"
                name="FB Pixel ID"
                rules="max:15|min:10|alpha_dash"
                tag="div"
            >
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">FB Pixel ID</span>
                    </label>
                    <input
                        @keyup="input"
                        :class="{'input-error': errors.length !== 0}"
                        v-model="analystic.fbPx" type="text" placeholder="1234567890" class="input input-bordered w-full">
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
                >儲存變更</button>
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

import AnalysticVO from "@/vo/design/setting/AnalysticVO";
import ResultModal from "@/components/widgets/upload/ResultModal";
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";


export default {
    components: {
        VP,
        ResultModal
    },
    props: {
        analystic: {
            type: AnalysticVO,
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
                name: 'anal-result',
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
                vBasicPageApi.pageAnalysticUpdate({
                    page_id: this.$store.state.pageId,
                    ga_id: this.analystic.ga_id,
                    fb_px: this.analystic.fb_px
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
