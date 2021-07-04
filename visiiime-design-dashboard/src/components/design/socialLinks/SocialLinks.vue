<template>
  <div class="p-2">
    <!-- <div>
      <pre>
        {{ socialLinks.list }}
      </pre>
    </div> -->
    <draggable :list="socialLinks.list" handle=".handle">
      <social-link
        v-for="(socialLink, idx) in socialLinks.list"
        :social-link="socialLink"
        :idx="idx"
        :key="idx"
        @remove-social-link="removeSocialLink"
      />
    </draggable>
    <div @click="openBrandSelect" class="flex items-center w-5/12 cursor-pointer">
      <div class="h-6 w-6 text-gray-700">
        <fai :icon="['fas', 'plus-circle']" size="lg" />
      </div>
      <div class="ml-3 border-gray-500 text-sm">
        Add New Social Media
      </div>
    </div>

    <modal name="brandSelect" :max-width="600" width="90%" height="auto" :adaptive="true">
      <div class="max-h-96 overflow-y-scroll">
        <div class="mx-auto bg-white rounded-lg overflow-hidden">
          <div class="p-5">
            <div class="w-full">
              <!-- <fai :icon="['far', 'envelope']" size="lg" />
              <fai :icon="['fab', 'facebook']" size="lg" />
              <fai :icon="['fab', 'instagram']" size="lg" /> -->
              <div v-for="(item, idx) in brandIcons" :key="idx">
                <div @click="addSocialLink(item.fa, item.icon)" class="flex border rounded p-3 mt-3 cursor-pointer">
                  <div class="text-2xl">
                    <fai :icon="[item.fa, item.icon]" size="lg" />
                  </div>
                  <div class="text-lg pl-3 flex items-center">
                    {{ item.name }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </modal>
  </div>
</template>

<script>
import { library } from '@fortawesome/fontawesome-svg-core'
import { faPlusCircle } from '@fortawesome/free-solid-svg-icons'
import { faEnvelope } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
library.add(faPlusCircle, faEnvelope, fab)

import SocialLink from "@/components/design/socialLinks/SocialLink";
import SocialLinkVO from "@/vo/design/socialLinks/SocialLinkVO";
import SocialLinksVO from "@/vo/design/socialLinks/SocialLinksVO";
import draggable from "vuedraggable";

import SocialLinksMixin from "@/mixins/VBasic/socialLinks/SocialLinksMixin";

export default {
  components: {
    SocialLink,
    draggable,
  },
  data() {
    return {
      linkLimit: 10,
      brandIcons: [
        {
          fa: 'far',
          icon: 'envelope',
          name: 'email'
        },
        {
          fa: 'fab',
          icon: 'facebook',
          name: 'facebook'
        },
        {
          fa: 'fab',
          icon: 'instagram',
          name: 'instagram'
        },
        {
          fa: 'fab',
          icon: 'youtube',
          name: 'youtube'
        },
        {
          fa: 'fab',
          icon: 'line',
          name: 'line'
        },
        {
          fa: 'fab',
          icon: 'weixin',
          name: 'weixin'
        },
      ]
    }
  },
  mixins: [
    SocialLinksMixin
  ],
  props: {
    socialLinks: {
      type: SocialLinksVO,
      required: true,
    },
  },
  methods: {
    openBrandSelect() {
      this.$modal.show('brandSelect');
    },
    addSocialLink(fa, icon) {
      let socialLink = new SocialLinkVO(fa, icon);
      this.socialLinks.list.push(socialLink);
      this.$modal.hide('brandSelect');
    },
    removeSocialLink(idx) {
      this.socialLinksMixin_removeSocialLink(idx);
    }
  },
  created() {
    this.socialLinksMixin_list = this.socialLinks;
  },
  mounted() {
    // this.$modal.show('brandSelect')
  }
};
</script>