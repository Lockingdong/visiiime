import UserTitleVO from '@/vo/design/profile/UserTitleVO'

export default {
  data() {
    return {
      userTitleMixin_userTitle: {
        type: UserTitleVO,
        required: true,
        default: null
      },
    };
  },
  computed: {
    userTitleMixin_getTitle() {
      let title = this.userTitleMixin_userTitle.title
      if(title.trim() === "") {
        return this.userTitleMixin_userTitle.defaultTitle
      }

      return title.trim()
    }
  },
  methods: {
    userTitleMixin_newTitle(title, defaultTitle) {
      this.userTitleMixin_userTitle = new UserTitleVO(title, defaultTitle);
    },
    userTitleMixin_setTitle(title, defaultTitle) {
      this.userTitleMixin_userTitle.title = title;
      this.userTitleMixin_userTitle.defaultTitle = defaultTitle;
    },
  },
};
