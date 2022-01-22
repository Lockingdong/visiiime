<template>
    <v-ob ref="vob" tag="div" class="p-3">
        <div class="flex justify-center align-middle mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
            </svg>
            <v-p v-slot="{ errors }" rules="required" name="標題名稱" tag="div" class="form-control w-full">
                <input
                    v-model="linkItem.linkName"
                    :id="'INPUT-' + linkItem.id"
                    :disabled="linkItem.online"
                    :class="{'input-error': errors.length !== 0}"
                    type="text"
                    autocomplete="off"
                    placeholder="標題名稱"
                    class="input input-sm input-bordered w-full">
                <div>
                    <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                </div>
            </v-p>
        </div>
        <div style="height: 24px;" class=" pl-6">
            <div class="badge badge-sm badge-primary">{{ 'TITLE' }}</div> 
        </div>
    </v-ob>
</template>

<script>
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import { CAN_USE_LINK_ITEM_NORMAL } from "@/enum/permission/vBasic/VPermission";
import { ValidationProvider as VP } from "vee-validate";

export default {
    components: {
        VP,
    },
    data() {
        return {
        }
    },
    props: {
        linkItem: {
            type: LinkItemVO,
            required: true,
        },
        idx: {
            type: Number,
            required: true,
        },
    },
    computed: {
        modalName() {
            return "linkItem" + this.idx;
        },
    },
    methods: {
        async validate() {
            try {

                const rs = await this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_NORMAL);
                if(!rs) {
                    throw 'permission deny'
                }

                const result = await this.$refs.vob.validate();
                if(!result) {
                    throw 'validate error'
                }

                return true

            } catch (err) {

                console.log(err)

                return false
            }
        },
        updateImage(imageUrl) {
            this.linkItem.thumbnail = imageUrl;
        },
    },
    watch: {
    },
    mounted() {        
    },
};
</script>

<style lang="scss" scoped></style>
