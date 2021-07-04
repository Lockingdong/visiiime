import VBasicCustomDataVO from "@/vo/theme/customData/VBasic/VBasicCustomDataVO";
import VBasicBackgroundVO from "@/vo/theme/customData/VBasic/VBasicBackgroundVO";
import VBasicLinkButtonVO from "@/vo/theme/customData/VBasic/VBasicLinkButtonVO";
import VBasicTextVO from "@/vo/theme/customData/VBasic/VBasicTextVO";

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
    /**
     * @param  {Boolean} customBgOn
     * @param  {String} bgType
     * @param  {String} bgName
     * @param  {String} bgContent
     * @param  {String} bgColor
     */
    customdDataMixin_setBackground(
      customBgOn,
      bgType,
      bgName,
      bgContent,
      bgColor
    ) {
      let vBasicBackgroundVO = new VBasicBackgroundVO(
        customBgOn,
        bgType,
        bgName,
        bgContent,
        bgColor
      );
      this.customdDataMixin_background = vBasicBackgroundVO
    },
    /**
     * @param {String} buttonName
     */
    customdDataMixin_setLinkButton(buttonName) {
      let vBasicLinkButtonVO = new VBasicLinkButtonVO(buttonName)
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