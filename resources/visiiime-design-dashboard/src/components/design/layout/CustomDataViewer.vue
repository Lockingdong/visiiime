<template>
    <div class="mb-10">
        <div class="text-xl mt-3 mb-3">custom data</div>
        <div class="card shadow-md bg-white relative overflow-scroll mb-3">
            <div class="p-5">
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">custom data</span>
                    </label> 
                    <input type="text" :value="customDataToStoreStr" placeholder="" class="input input-bordered">
                </div>
            </div>
            <div class="p-5">
                <pre class="text-sm">{{ customDataToStore }}</pre>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    props: {
        originalContent: {
            type: Object,
            required: true
        },
    },
    computed: {
        customDataToStore() {
            let customData = JSON.parse(JSON.stringify(this.originalContent.customData));
            delete customData.background.bgCustomImage;

            return customData;
        },
        customDataToStoreStr() {
            return JSON.stringify(this.customDataToStore)
        }
    }
}
</script>
