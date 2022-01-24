import LayoutVO from '@/vo/design/layout/LayoutVO'

export default {
  data() {
    return {
      layoutMixin_layout: {
        type: LayoutVO,
        required: true,
      },
    };
  },
  methods: {
    layoutMixin_newLayout(layoutCode) {
      this.layoutMixin_layout = new LayoutVO(layoutCode);
    },
    layoutMixin_setLayout(layoutCode) {
      this.layoutMixin_layout.layoutCode = layoutCode;
    },
  },
};
