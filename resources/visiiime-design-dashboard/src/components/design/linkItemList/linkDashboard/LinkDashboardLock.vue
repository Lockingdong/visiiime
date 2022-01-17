<template>
  <v-ob ref="vob" tag="div" class="mb-3">
        <div class="text-center bg-gray-500 text-white py-1">密碼保護</div>
        <div v-if="hasPermission" class="p-5">
            <v-p v-slot="{ errors }" :rules="'max:4|min:4'" name="密碼" class="form-control" tag="div">
                <label class="label">
                    <span class="label-text">密碼</span>
                </label> 
                <input v-model="pwd" type="password" minlength="4" maxlength="4" placeholder="請輸入密碼" 
                    :class="{'input-error': errors.length !== 0}"
                    class="input input-sm input-bordered"
                >
                <div>
                    <span v-show="errors.length" class="badge badge-error mt-1 mr-1">{{ errors[0] }}</span>
                </div>
            </v-p> 
            <div class="flex justify-center mt-3">
                <button @click="updatePwd" class="btn btn-primary">儲存</button>
            </div>
        </div>
        <div v-else class="p-5">
            <normal-alert></normal-alert>
        </div>
    </v-ob>
</template>
<script>
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import { ValidationProvider as VP } from "vee-validate";
import { CAN_USE_LINK_ITEM_DBOARD_PWD } from "@/enum/permission/vBasic/VPermission";
import vBasicLinkItemApi from "@/api/VBasic/VBasicLinkItemApi";
import NormalAlert from "@/components/widgets/permission/NormalAlert";

export default {
    data() {
        return {
            pwd: ''
        }
    },
    components: {
        VP,
        NormalAlert
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
        hasPermission() {
            return this.$store.getters.hasPermission(CAN_USE_LINK_ITEM_DBOARD_PWD);
        },
    },
    methods: {
        async updatePwd() {
            const res = await this.$refs.vob.validate()

            if(res) {
                vBasicLinkItemApi.linkItemPwdUpdate({
                    id: this.linkItem.id,
                    link_pwd: this.pwd,
                })
                .then(rs => {

                    console.log(rs.data)

                    this.$modal.show('result-modal', {
                        header: '更新成功'
                    })
                    this.linkItem.linkPwd = rs.data.pwd;

                    this.showSaveBtn = false;

                }).catch(error => {
                    console.log(error)
                    this.$modal.show('result-modal', {
                        header: '發生錯誤'
                    })
                })
            }
        }
    },
    mounted() {
        this.pwd = this.linkItem.linkPwd
    }
};
</script>
<style lang="scss" scoped>
</style>