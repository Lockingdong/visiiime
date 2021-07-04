import AvatarVO from '@/vo/design/profile/AvatarVO'

export default {
  data() {
    return {
      avatarMixin_avatar: {
        type: AvatarVO,
        required: true,
        default: null
      },
    };
  },
  computed: {
    avatarMixin_getAvatarUrl() {
      return this.avatarMixin_avatar.avatarUrl
    }
  },
  methods: {
    avatarMixin_newAvatarUrl(avatarUrl) {
      this.avatarMixin_avatar = new AvatarVO(avatarUrl);
    },
    avatarMixin_setAvatarUrl(avatarUrl) {
      this.avatarMixin_avatar.avatarUrl = avatarUrl;
    },
  },
};
