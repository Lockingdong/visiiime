import VBasicCustomDataVO from "@/vo/theme/customData/VBasic/VBasicCustomDataVO";
import VBasicBackgroundVO from "@/vo/theme/customData/VBasic/VBasicBackgroundVO";
import VBasicLinkButtonVO from "@/vo/theme/customData/VBasic/VBasicLinkButtonVO";
import VBasicTextVO from "@/vo/theme/customData/VBasic/VBasicTextVO";
import BackgroundVO from "@/vo/theme/customData/VBasic/VBasicBackgroundVO";

export default {
  data() {
    return {
      customdDataMixin_customData: {
        type: VBasicCustomDataVO,
        required: true,
      },
      customdDataMixin_background: {
        type: VBasicBackgroundVO,
        required: true,
      },
      customdDataMixin_linkButton: {
        type: VBasicLinkButtonVO,
        required: true,
      },
      customdDataMixin_text: {
        type: VBasicTextVO,
        required: true,
      }
    }
  },
  methods: {
    customdDataMixin_newCustomData() {
      this.customdDataMixin_customData = new VBasicCustomDataVO(
        this.customdDataMixin_background,
        this.customdDataMixin_linkButton,
        this.customdDataMixin_text
      );
    },
    customdDataMixin_setCustomData() {
      this.customdDataMixin_customData.background = this.customdDataMixin_background
      this.customdDataMixin_customData.linkButton = this.customdDataMixin_linkButton
      this.customdDataMixin_customData.text = this.customdDataMixin_text
    },
    /** @param  {BackgroundVO} backgroundVO */
    customdDataMixin_setBackground(
        backgroundVO
    ) {
      let vBasicBackgroundVO = new VBasicBackgroundVO(
        backgroundVO
      );
      this.customdDataMixin_background = vBasicBackgroundVO
    },
    /**
     * @param {String} buttonName
     */
    customdDataMixin_setLinkButton(vLinkButtonVO) {
      let vBasicLinkButtonVO = new VBasicLinkButtonVO(vLinkButtonVO)
      this.customdDataMixin_linkButton = vBasicLinkButtonVO;
    },
    /**
     * @param {String} textColor
     */
    customdDataMixin_setText(textColor) {
      let vBasicTextVO = new VBasicTextVO(textColor)
      this.customdDataMixin_text = vBasicTextVO;
    },
  }
}
