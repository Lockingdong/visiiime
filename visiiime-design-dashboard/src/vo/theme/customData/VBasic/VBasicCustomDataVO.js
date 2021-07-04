class VBasicCustomDataVO {
  /**
   * @param  {backgroundVO} backgroundVO
   * @param  {buttonVO} buttonVO
   * @param  {textVO} textVO
   */
  constructor(
    backgroundVO,
    buttonVO,
    textVO
  ) {
    this.background = backgroundVO;
    this.button = buttonVO;
    this.text = textVO;
  }
}

export default VBasicCustomDataVO;
