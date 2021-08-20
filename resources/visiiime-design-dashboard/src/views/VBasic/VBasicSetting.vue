<template>
    <div class="setting">
        <v-ob
            tag="div"
            class="mb-10"
            ref="url-vob"
            >
            <div class="text-2xl mb-3">網址設定</div>
            <v-p
                v-slot="{ errors }"
                class="card shadow-md mb-3 p-3 bg-white relative"
                rules="required|max:20"
                tag="div"
            >
                <div
                    :data-tip="errors[0]"
                    class="form-control tooltip tooltip-open tooltip-bottom tooltip-error"
                    >
                    <label class="label">
                        <span class="label-text">網址路徑</span>
                    </label>
                    <input type="text" placeholder="您的網址名稱" class="input input-bordered w-full">
                </div>
                <div class="justify-end card-actions">
                    <button class="btn btn-primary inline-block">儲存</button>
                </div>
            </v-p>
        </v-ob>
        <div class="mb-10">
            <div class="text-2xl mb-3">追蹤設定</div>
            <div class="card shadow-md mb-3 p-3 bg-white relative">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Google Analystic ID</span>
                    </label>
                    <input type="text" placeholder="UA-000000-2" class="input input-bordered">
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">FB Pixel ID</span>
                    </label>
                    <input type="text" placeholder="1234567890" class="input input-bordered">
                </div>
                <div class="justify-end card-actions">
                    <button class="btn btn-primary inline-block">儲存</button>
                </div>
            </div>
        </div>
        <div class="mb-10">
            <div class="text-2xl mb-3">SEO 設定</div>
            <div class="card shadow-md mb-3 p-3 bg-white relative">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">網頁標題</span>
                    </label>
                    <input type="text" placeholder="" class="input input-bordered">
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">網頁描述</span>
                    </label>
                    <input type="text" placeholder="" class="input input-bordered">
                </div>
                <div class="justify-end card-actions">
                    <button class="btn btn-primary inline-block">儲存</button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import { ValidationProvider as VP } from 'vee-validate'

export default {
    components: {
        VP
    },
    props: {
        originalContent: {
            type: Object,
            required: true,
        },
    },

};
</script>
