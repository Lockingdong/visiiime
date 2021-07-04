<template>
  <div class="flex mb-5">
    <div class="h-6 w-6 text-gray-700 handle">
      <fai :icon="[socialLink.fa, socialLink.icon]" size="lg" />
    </div>
    <div class="ml-3 border-gray-500 w-full text-sm">
      <v-ob ref="vob">
        <v-p
          v-slot="{ errors, classes }"
          :rules="rulesAndName.rules"
          :name="rulesAndName.fieldName"
          tag="div"
          class="w-full"
        >
          <input
            v-show="editable"
            v-model="socialLink.link"
            @blur="closeEdit"
            ref="linkInput"
            class="
              appearance-none
              border
              w-full
              py-2
              px-3
              text-gray-700
              leading-tight
              focus:outline-none
              focus:shadow-outline
            "
            type="text"
            placeholder="https://www.example.com"
          />
          <div @click="openEdit" v-show="!editable" :class="classes" class="border-b border-gray-300 h-6">
            {{ socialLink.link }}
          </div>
          <div class="mb-1 w-full text-red-500 text-xs">{{ errors[0] }}</div>
        </v-p>
      </v-ob>
    </div>

    <div>
      <svg
        @click="openEdit"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5 text-gray-600 fill-current cursor-pointer"
        viewBox="0 0 20 20"
        fill="currentColor"
      >
        <path
          d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
        />
      </svg>
    </div>
    <div>
      <svg
        @click="removeSocialLink"
        xmlns="http://www.w3.org/2000/svg"
        class="h-5 w-5 text-red-300 cursor-pointer"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="1"
          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
        />
      </svg>
    </div>
    <!-- {{ socialLink }} -->
  </div>
</template>


<script>
// import { library } from "@fortawesome/fontawesome-svg-core";
// import { fab } from "@fortawesome/free-brands-svg-icons";
// library.add(fab);

import SocialLinkVO from "@/vo/design/socialLinks/SocialLinkVO";
import { ValidationProvider as VP } from "vee-validate";

import { confirmSetting } from "@/helper/alertSetting";

export default {
  data() {
    return {
      editable: false,
    };
  },
  components: {
    VP,
  },
  props: {
    socialLink: {
      type: SocialLinkVO,
      required: true,
    },
    idx: {
      type: Number,
      required: false,
    },
  },
  computed: {
    rulesAndName() {
      let rule = '';
      let fieldName = '';
      switch (this.socialLink.icon) {
        case 'envelope':
          rule = 'email';
          fieldName = 'Email';
          break;
        default:
          rule = 'url';
          fieldName = '連結';
          break;
      }
      // return `required|${rule}`
      return {
        rules: `required|${rule}`,
        fieldName
      }
    }
  },
  methods: {
    removeSocialLink() {
      this.$swal({
        ...confirmSetting,
        text: "確定要刪除嗎",
      }).then((result) => {
        if (result.isConfirmed) {
          this.$emit("remove-social-link", this.idx);
        }
      });
    },
    async validate() {
      const result = await this.$refs.vob.validate();
      if (!result) {
        // post api
        this.socialLink.valid = false;
      } else {
        this.socialLink.valid = true;
      }
    },
    openEdit() {
      this.editable = true;
      this.$nextTick(() => {
        this.$refs.linkInput.focus();
      });
    },
    closeEdit() {
      this.editable = false;
      this.validate();
    }
  },
  created() {
    if(this.socialLink.link !== "") {
      this.$nextTick(() => {
        this.validate();
      });
    }
  },
  mounted() {
    if(this.socialLink.link === "") {
      this.editable = true;
      this.$nextTick(() => {
        this.$refs.linkInput.focus();
      });
    }
  }
};
</script>

<style lang="scss" scoped>
</style>