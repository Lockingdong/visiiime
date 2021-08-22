import UrlVO from "@/vo/design/setting/UrlVO";

export default {
    data() {
        return {
            urlMixin_url: {
                type: UrlVO,
                required: true,
                default: null
            }
        };
    },
    methods: {
        urlMixin_newUrl(pageUri) {
            this.urlMixin_url = new UrlVO(pageUri);
        },
        urlMixin_setUrl(pageUri) {
            this.urlMixin_url.pageUri = pageUri;
        }
    }
};
