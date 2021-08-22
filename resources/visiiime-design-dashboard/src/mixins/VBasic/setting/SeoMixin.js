import SeoVO from "@/vo/design/setting/SeoVO";

export default {
    data() {
        return {
            seoMixin_seo: {
                type: SeoVO,
                required: true,
                default: null
            }
        };
    },
    methods: {
        seoMixin_newSeo(seoTitle, seoDesc) {
            this.seoMixin_seo = new SeoVO(seoTitle, seoDesc);
        },
        seoMixin_setSeo(seoTitle, seoDesc) {
            this.seoMixin_seo.seoTitle = seoTitle;
            this.seoMixin_seo.seoDesc = seoDesc;
        }
    }
};
