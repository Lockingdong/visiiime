<template>
  <div>
    <v-ob ref="vob">
      <div v-show="!titleEditable" class="flex justify-start align-middle">
        <div class="text-gray-600">{{ title }}</div>
        <svg
          @click="titleEditClick"
          xmlns="http://www.w3.org/2000/svg"
          class="bottom-0 ml-2 h-5 w-5 text-gray-600 fill-current cursor-pointer"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
          />
        </svg>
      </div>
      <div v-show="titleEditable" class="block">
        <v-p
          v-slot="{ errors }"
          rules="required|max:15"
          name="標題"
          tag="div"
          class="w-full"
        >
          <input
            @blur="titleEditable = !titleEditable"
            ref="titleInput"
            class="w-full text-sm p-2 border rounded focus:border-purple-100 outline-none"
            :placeholder="userTitle.defaultTitle + '...'"
            v-model="userTitle.title"
          />
          <div class="mb-5 w-full text-red-500 text-xs">{{ errors[0] }}</div>
        </v-p>
      </div>
    </v-ob>
  </div>
</template>

<script>

import { ValidationProvider as VP } from 'vee-validate'
import UserTitleVO from '@/vo/design/profile/UserTitleVO'
import vBasicPageApi from "@/api/VBasic/VBasicPageApi";

export default {
  data() {
    return {
      titleEditable: false
    }
  },
  components: {
    VP
  },
  props: {
    userTitle: {
      type: UserTitleVO,
      required: true
    }
  },
  computed: {
    title() {
      if(this.userTitle.title === "") {
        return this.userTitle.defaultTitle;
      }

      return this.userTitle.title;
    }
  },
  methods: {
    titleEditClick() {
      this.titleEditable = !this.titleEditable;
      this.$nextTick(() => {
        this.$refs.titleInput.focus();
      });
    },
    async validate() {
      const result = await this.$refs.vob.validate()
      if (!result) {
        this.userTitle.valid = false
      } else {
        this.userTitle.valid = true
        vBasicPageApi.updatePageData({
            page_id: this.$store.state.pageId,
            field: 'user_title',
            data: this.userTitle.title
        }).then(rs => {

        }).catch(error => {
            console.log(error.response.data);
            alert('發生錯誤')
        });
      }
    }
  },
  watch: {
    'userTitle.title'() {
      this.validate()
    }
  },
  mounted() {
    this.validate()
  }
}
</script>

<style lang="scss">
.my-text {
  min-height: 50px;
}
</style>
