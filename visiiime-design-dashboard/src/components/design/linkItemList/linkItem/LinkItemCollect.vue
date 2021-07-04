<template>
  <v-ob ref="vob" tag="div" class="p-2">
    <select v-model="linkItem.collector.collectType">
      <option value="email">email</option>
      <option value="lineId">lineId</option>
    </select>
    <div class="flex justify-center align-middle">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
        />
      </svg>
      <v-p v-slot="{ errors }" rules="required" name="連結名稱" tag="div" class="w-full">
        <input
          v-model="linkItem.linkName"
          :disabled="linkItem.online"
          type="text"
          class="w-full text-xs p-2 focus:border-red-100 outline-none"
          autocomplete="off"
          placeholder="連結名稱"
          @blur="validate"
          required
        />
        <div class="mb-5 w-full text-red-500 text-xs">{{ errors[0] }}</div>
      </v-p>
    </div>
    <div class="flex justify-center align-middle">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
        />
      </svg>
      <v-p v-slot="{ errors }" rules="required" name="表單標題" tag="div" class="w-full">
        <input
          v-model="linkItem.collector.collectTitle"
          :disabled="linkItem.online"
          type="text"
          class="w-full text-xs p-2 focus:border-red-100 outline-none"
          autocomplete="off"
          placeholder="表單標題"
          @blur="validate"
          required
        />
        <div class="mb-5 w-full text-red-500 text-xs">{{ errors[0] }}</div>
      </v-p>
    </div>
    <div class="flex justify-center align-middle mb-2">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5 mt-1 text-gray-600 fill-current cursor-pointer"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
        />
      </svg>
      <v-p v-slot="{ errors }" rules="required" name="送出回應訊息" tag="div" class="w-full">
        <input
          v-model="linkItem.collector.collectRsp"
          :disabled="linkItem.online"
          type="text"
          class="w-full text-xs p-2 focus:border-red-100 outline-none"
          autocomplete="off"
          placeholder="送出回應訊息"
          @blur="validate"
          required
        />
        <div class="mb-5 w-full text-red-500 text-xs">{{ errors[0] }}</div>
      </v-p>
    </div>
  
  </v-ob>
</template>


<script>
import LinkItemVO from "@/vo/design/linkItemList/LinkItemVO";
import { ValidationProvider as VP } from "vee-validate";

export default {
  components: {
    VP,
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
      const result = await this.$refs.vob.validate();
      if (!result) {
        // post api
        this.linkItem.online = false;
        this.linkItem.valid = false;
      } else {
        this.linkItem.valid = true;
      }
    },
    updateImage(imageUrl) {
      this.linkItem.thumbnail = imageUrl;
    },
    openUploadImageForm() {
      this.$modal.show(this.modalName);
    },
  },
  watch: {
    "linkItem.online"() {
      this.validate();
    },
  },
  mounted() {
    this.validate();
  },
};
</script>

<style lang="scss" scoped>
</style>