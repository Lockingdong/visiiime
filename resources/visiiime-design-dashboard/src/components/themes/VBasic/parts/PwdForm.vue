<template>
    <div v-if="pwdFormOpen"
        @click.self="closeWindow"
        class="pwd-modal"
        :style="{
            position: isDemo ? 'absolute' : 'fixed'
        }"
    >
        <div class="window-wrapper" style="text-align: center;">
            <div class="collector-form">
                <div class="collector-form">
                    <template v-if="step === 'step1'">
                        <div class="title">請輸入連結密碼</div>
                        <div class="ans">
                            <input v-model="pwd" type="password" minlength="4" maxlength="4" :placeholder="placeholder" />
                            <div v-if="errorMessage !== ''" class="error">* {{ errorMessage }}</div>
                        </div>
                        <div class="submit">
                            <button @click="submit">送出</button>
                        </div>
                    </template>
                    <template v-if="step === 'step2'">
                        <div>
                            <spinner-circle />
                        </div>
                    </template>
                    <template v-if="step === 'step3'">
                        <div v-if="rspStatus === 'succ'" class="rsp">
                            {{ rsp }}
                        </div>
                        <div v-else class="rsp">
                            {{ rsp }}
                        </div>
                        <div class="submit">
                            <button @click="closeWindow">關閉</button>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import SpinnerCircle from '../../../widgets/spinner/SpinnerCircle.vue';
import vBasicLinkItemApi from "../../../../api/VBasic/VBasicLinkItemApi";

export default {
    data() {
        return {
            step: 'step1', // step1, step2, step3 
            rspStatus: '', // succ, fail
            pwd: '',
            rsp: '',
            errorMessage: '',
            placeholder: ''
        }
    },
    components: {
        SpinnerCircle
    },
    props: {
        linkId: {
            type: String,
            required: true,
        },
        linkItems: {
            type: Object,
            required: true
        },
        linkItemsMain: {
            type: Object,
            required: true
        },
        isDemo: {
            type: Boolean,
            required: true
        }
    },
    computed: {
        pwdFormOpen() {
            return this.linkId !== '';
        },
        allLinkItems() {
            return [...this.linkItems.list, ...this.linkItemsMain.list]
        }
    },
    methods: {
        closeWindow() {
            this.resetPwdData()
            this.$emit("close-pwd-form");
        },
        validate() {
            if(this.pwd.length < 4) {
                this.errorMessage = '密碼格式錯誤';
                return false;
            }
            this.errorMessage = '';
            return true;
        },
        submit() {

            const rs = this.validate();

            if(!rs) {
                return;
            }

            this.step = 'step2'

            vBasicLinkItemApi.linkItemCheckPwdCorrect({
                id: this.linkId,
                link_pwd: this.pwd
            }).then(rs => {

                if(rs.data.result) {
                    this.rspStatus = 'succ'
                    // console.log(this.linkItemsMain)
                    // 清空密碼
                    let find = this.allLinkItems.find(item => item.id === this.linkId)
                    if(find !== undefined) {
                        find.linkPwd = ''
                        find.link = rs.data.link
                        console.log(find)
                        console.log(this.linkItemsMain)
                    }
                    // this.linkItemsMain.list = []
                    this.rsp = '輸入正確，即將前往連結...'
                    
                    if(this.isDemo) {
                        setTimeout(() => {
                            window.open(rs.data.link, '_blank')
                        }, 1000)
                    } else {
                        setTimeout(() => {
                            window.open(rs.data.link)
                        }, 1000)
                    }

                } else {
                    this.rspStatus = 'fail'
                    this.rsp = '輸入錯誤'
                }

                this.step = 'step3'

            }).catch(err => {
                console.log(err)
                this.rsp = '發生錯誤';

                this.rspStatus = 'fail';
                this.step = 'step3';
                
            })

        },
        resetPwdData() {
            this.step = 'step1';
            this.rspStatus = '';
            this.errorMessage = '';
            this.rsp = '';
            this.pwd = '';
        }
    },
    watch: {
    },
    mounted() {
    }
};
</script>
<style lang="scss" scoped>
.pwd-modal {
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(#000, 0.5);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    transition: 0.3s;
    display: flex;
    justify-content: center;
    align-items: center;
    .title {
        margin-bottom: 15px;
    }
    .ans {
        margin-bottom: 15px;
        input {
            padding: 5px;
        }
        .error {
            color: #f23;
            font-size: 12px;
        }
    }
    .submit {
        text-align: center;
        button {
            background-color: #333;
            color: #fff;
            padding: 5px 12px;
            border-radius: 5px;
        }
    }
    .rsp {
        margin-bottom: 20px;
    }
    .window-wrapper {
        width: 100%;
        padding: 0 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .collector-form {
        width: 100%;
        text-align: center;
        background-color: #fff;
        border-radius: 10px;
        padding: 5px;
        max-width: 300px;
        input {
            width: 200px;
            border: 1px solid;
            border-radius: 5px;
            font-size: 14px;
        }
    }
}

</style>
