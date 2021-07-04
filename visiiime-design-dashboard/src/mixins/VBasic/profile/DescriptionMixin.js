import DescriptionVO from '@/vo/design/profile/DescriptionVO'

export default {
  data() {
    return {
      descriptionMixin_description: {
        type: DescriptionVO,
        required: true,
        default: null
      },
    };
  },
  computed: {
    descriptionMixin_getText() {
      return this.descriptionMixin_description.text
    }
  },
  methods: {
    descriptionMixin_newText(text) {
      this.descriptionMixin_description = new DescriptionVO(text);
    },
    descriptionMixin_setText(text) {
      this.descriptionMixin_description.text = text;
    },
  },
};
