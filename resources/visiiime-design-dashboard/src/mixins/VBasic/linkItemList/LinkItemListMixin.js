import LinkItemVO from '@/vo/design/linkItemList/LinkItemVO';
import LinkItemListVO from '@/vo/design/linkItemList/LinkItemListVO';


export default {
  data() {
    return {
      linkItemListMixin_list: {
        type: LinkItemListVO,
        required: true
      },
      linkItemListMixin_listMain: {
        type: LinkItemListVO,
        required: true
      },
    };
  },
  computed: {
    linkItemListMixin_getList() {
      return this.linkItemListMixin_list.list.map(item => {
        return {
          linkName: item.linkName,
          link: item.link,
          online: item.online
        }
      });
    }
  },
  methods: {
    linkItemListMixin_newListMain(arr) {

      this.linkItemListMixin_listMain = new LinkItemListVO();

      arr.forEach(item => {
        let linkItem = new LinkItemVO(item);
        this.linkItemListMixin_listMain.list.push(linkItem);
      });
    },
    linkItemListMixin_setListMain(arr) {
      arr.forEach(item => {
        let linkItem = new LinkItemVO(item);
        this.linkItemListMixin_listMain.list.push(linkItem);
      });
    },
    linkItemListMixin_removeLinkItem(id) {
      this.linkItemListMixin_list.list = this.linkItemListMixin_list.list.filter(
        item => item.id !== id
      );
    },
    linkItemListMixin_newList(arr) {

      this.linkItemListMixin_list = new LinkItemListVO();

      arr.forEach(item => {
        let linkItem = new LinkItemVO(item);
        this.linkItemListMixin_list.list.push(linkItem);
      });
    },
    linkItemListMixin_setList(arr) {
        console.log(arr)
      arr.forEach(item => {
        let linkItem = new LinkItemVO(item);
        this.linkItemListMixin_list.list.push(linkItem);
      });
    }
  }
};
