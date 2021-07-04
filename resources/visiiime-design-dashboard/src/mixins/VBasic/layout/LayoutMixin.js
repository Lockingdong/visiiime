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
    layoutMixin_newLayout(layoutName, layoutId, layoutClass = '') {
      this.layoutMixin_layout = new LayoutVO(layoutName, layoutId, layoutClass);
    },
    layoutMixin_setLayout(layoutName, layoutId, layoutClass = '') {
      this.layoutMixin_layout.layoutName = layoutName;
      this.layoutMixin_layout.layoutId = layoutId;
      this.layoutMixin_layout.layoutClass = (layoutClass === '') ? layoutName : layoutClass;
    },
  },
};
