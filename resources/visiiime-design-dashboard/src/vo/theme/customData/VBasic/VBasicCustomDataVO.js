class VBasicCustomDataVO {
  /**
   * @param  {backgroundVO} backgroundVO
   * @param  {buttonVO} buttonVO
   * @param  {textVO} textVO
   * @param  {supportVO} supportVO
   */
  constructor(
    backgroundVO,
    buttonVO,
    textVO,
    supportVO
  ) {
    this.background = backgroundVO;
    this.linkButton = buttonVO;
    this.text = textVO;
    this.support = supportVO;
  }
}

export default VBasicCustomDataVO;
