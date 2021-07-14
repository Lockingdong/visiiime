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
  computed: {
    layoutMixin_getLayoutName() {
      return this.layoutMixin_layout.layoutName
    }
  },
  methods: {
    layoutMixin_newLayout(layoutName, layoutCode, layoutClass = '') {
      this.layoutMixin_layout = new LayoutVO(layoutName, layoutCode, layoutClass);
    },
    layoutMixin_setLayout(layoutName, layoutCode, layoutClass = '') {
      this.layoutMixin_layout.layoutName = layoutName;
      this.layoutMixin_layout.layoutCode = layoutCode;
      this.layoutMixin_layout.layoutClass = (layoutClass === '') ? layoutName : layoutClass;
    },
  },
};
