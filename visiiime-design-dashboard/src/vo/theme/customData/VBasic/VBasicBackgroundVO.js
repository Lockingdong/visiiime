import BackgroundBaseVO from '../BackgroundVO';

class BackgroundVO extends BackgroundBaseVO {

  /**
   * bgType: svg | css | background
   * bgName: bgImage (自行上傳背景圖) | bg1 | bg2
   * 
   * 
   */

  /**
   * @param  {Boolean} customBgOn
   * @param  {String} bgType
   * @param  {String} bgName
   * @param  {String} bgContent
   * @param  {String} bgColor
   */
  constructor(
    customBgOn,
    bgType,
    bgName,
    bgContent,
    bgColor = "#DDE6E8"
  ) {
    super(
      customBgOn,
      bgType,
      bgName,
      bgContent,
      bgColor
    );
  }

}

export default BackgroundVO;
