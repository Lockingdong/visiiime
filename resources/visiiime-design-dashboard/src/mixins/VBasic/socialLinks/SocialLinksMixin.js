import SocialLinkVO from "@/vo/design/socialLinks/SocialLinkVO";
import SocialLinksVO from "@/vo/design/socialLinks/SocialLinksVO";

export default {
    data() {
        return {
            socialLinksMixin_list: {
                type: SocialLinksVO,
                required: true,
            },
        };
    },
    computed: {
        socialLinksMixin_getList() {
            return this.socialLinksMixin_list.list;
        },
    },
    methods: {
        socialLinksMixin_addSocialLink(fa, icon) {
            let socialLink = new SocialLinkVO(fa, icon);
            this.socialLinksMixin_list.list.push(socialLink);
        },
        socialLinksMixin_removeSocialLink(idx) {
            this.socialLinksMixin_list.list.splice(idx, 1);
        },
        socialLinksMixin_newList(arr) {
            this.socialLinksMixin_list = new SocialLinksVO();

            arr.forEach((item) => {
                let linkItem = new SocialLinkVO(item.fa, item.icon, item.link, item.valid);
                this.socialLinksMixin_list.list.push(linkItem);
            });
        },
        socialLinksMixin_setList(arr) {

            if(arr === null) {
                return;
            }

            arr.forEach((item) => {
                let linkItem = new SocialLinkVO(item.fa, item.icon, item.link, item.valid);
                this.socialLinksMixin_list.list.push(linkItem);
            });
        },
    },
};
