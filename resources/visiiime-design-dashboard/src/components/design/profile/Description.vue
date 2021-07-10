<template>
  <div class="mb-5">
    <div class="text-right relative">
      <svg
        @click="textEditClick"
        xmlns="http://www.w3.org/2000/svg"
        class="inline-block bottom-0 ml-2 h-5 w-5 text-gray-600 fill-current cursor-pointer absolute right-0 top-0"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
        />
      </svg>
    </div>
    <v-ob ref="vob">
      <div v-show="!textEditable" class="text-sm text-gray-600 border-b-2 border-gray-500 min-h-0">{{ text }}</div>
      <div v-show="textEditable" class="block">
        <v-p
          v-slot="{ errors }"
          rules="required|max:100"
          name="簡介"
          tag="div"
          class="w-full"
        >
          <textarea
            @blur="textEditable = !textEditable"
            ref="textInput"
            class="w-full text-sm p-2 border rounded focus:border-purple-100 outline-none"
            rows="3"
            placeholder="簡介"
            v-model="description.text"
          ></textarea>
          <div class="mb-5 w-full text-red-500 text-xs">{{ errors[0] }}</div>
        </v-p>
      </div>
    </v-ob>
  </div>
</template>

<script>

import { ValidationProvider as VP } from 'vee-validate'
import DescriptionVO from '@/vo/design/profile/DescriptionVO'
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";

export default {
  data() {
    return {
      textEditable: false
    }
  },
  components: {
    VP
  },
  props: {
    description: {
      type: DescriptionVO,
      required: true
    }
  },
  computed: {
    text() {
      if(this.description.text === "") {
        return '請輸入您的簡介...';
      }

      return this.description.text;
    }
  },
  methods: {
    textEditClick() {
      this.textEditable = !this.textEditable;
      this.$nextTick(() => {
        this.$refs.textInput.focus();
      });
    },
    async validate() {
      const result = await this.$refs.vob.validate()
      if (!result) {
        this.description.valid = false
      } else {
        this.description.valid = true

        vBasicPageApi.updatePageData({
            page_id: this.$store.state.pageId,
            field: 'description',
            data: this.description.text
        }).then(rs => {

        }).catch(error => {
            console.log(error.response.data);
            alert('發生錯誤')
        });
      }
    }
  },
  watch: {
    'description.text'() {
      this.validate()
    }
  },
  mounted() {
    this.validate()
  }
}
</script>

<style lang="scss">
// .my-text {
//   // min-height: 50px;
// }
</style>
