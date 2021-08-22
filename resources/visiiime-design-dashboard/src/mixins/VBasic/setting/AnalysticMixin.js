import AnalysticVO from "@/vo/design/setting/AnalysticVO";

export default {
    data() {
        return {
            analysticMixin_analystic: {
                type: AnalysticVO,
                required: true,
                default: null
            }
        };
    },
    methods: {
        analysticMixin_newAnalystic(gaId, fbPx) {
            this.analysticMixin_analystic = new AnalysticVO(gaId, fbPx);
        },
        analysticMixin_setAnalystic(gaId, fbPx) {
            this.analysticMixin_analystic.gaId = gaId;
            this.analysticMixin_analystic.fbPx = fbPx;
        }
    }
};
