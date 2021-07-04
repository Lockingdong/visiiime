<template>
  <div v-if="formOpen" @click.self="closeModal" class="collector-modal">
    <div class="window-wrapper">
      <div class="collector-form">
        <div class="collector-form">
          <template v-if="step === 'step1'">
            <div class="title">{{ collectTitle }}</div>
            <div class="ans">
              <input v-model="ans" type="text" :placeholder="placeholder"> 
              <div v-if="errorMessage !== ''" class="error">* {{ errorMessage }}</div>
            </div>
            <div class="submit">
              <button @click="submit">送出</button>   
            </div>
          </template>
          <template v-if="step === 'step2'">
            <div>
              <spinner-circle/>
            </div>
          </template>
          <template v-if="step === 'step3'">
            <div v-if="rspStatus === 'succ'" class="rsp">
              {{ collectRsp }}
            </div>
            <div v-else class="rsp">
              發生錯誤, 請重新操作
            </div>
            <div class="submit">
              <button @click="closeModal">關閉</button>   
            </div>
          </template>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import SpinnerCircle from '../../../widgets/spinner/SpinnerCircle.vue';


export default {
  components: { 
    SpinnerCircle 
  },
  data() {
    return {
      step: 'step1', // step1, step2, step3 
      rspStatus: '', // succ, fail
      ans: '',
      errorMessage: ''
    }
  },
  props: {
    linkId: {
      // type: String,
      required: true,
    },
    collectTitle: {
      type: String,
      required: true,
    },
    collectRsp: {
      type: String,
      required: true,
    },
    collectType: {
      type: String,
      required: true,
    }
  },
  computed: {
    formOpen() {
      return this.linkId !== '' 
            && this.collectTitle !== ''
            && this.collectRsp !== ''
            && this.collectType !== '';
    },
    placeholder() {
      return `請輸入您的 ${this.collectType}`
    }
  },
  methods: {
    closeWindow() {
      this.$emit('close-form')
    },
    submit() {
      if(this.ans === '') {
        this.errorMessage = this.placeholder;
        return;
      }

      if(this.ans.length > 25) {
        this.errorMessage = '輸入文字過長';
        return;
      }

      if(this.collectType === 'email') {
        if(!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(this.ans)) {
          this.errorMessage = 'email格式錯誤';
          return;
        }
      }

      this.errorMessage = ''

      this.step = 'step2'

      setTimeout(() => {
        this.rspStatus = 'succ'
        this.step = 'step3'
      }, 1000)

      //axios ...

    },
    closeModal() {
      this.step = 'step1';
      this.rspStatus = '';
      this.ans = '';
      this.errorMessage = '';
      this.closeWindow();

    }
  },
};
</script>
<style lang="scss" scoped>
.collector-modal {
  position: absolute;
  width: 100%;
  height: 100%;
  background: rgba(#000, 0.5);
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transition: .3s;
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