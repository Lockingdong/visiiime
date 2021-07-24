import BaseVO from "@/vo/BaseVO";
class VBasicLinkButtonVO extends BaseVO{

  /**
   * @param {String} buttonName = ''
   * @param {String} buttonBorder = ''
   * @param {String} buttonRadius = ''
   * @param {String} buttonBgColor = ''
   * @param {String} buttonTextColor = ''
   */
  constructor(obj) {
        if (typeof obj !== "object") {
            console.log('VBasicLinkButtonVO type error')
        }
      super(obj, false);
  }

}

export default VBasicLinkButtonVO;
