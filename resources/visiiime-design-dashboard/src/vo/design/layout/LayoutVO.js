
class LayoutVO {
  constructor(layoutName, layoutCode, layoutClass = '') {
    this.layoutName = layoutName
    this.layoutCode = layoutCode
    this.layoutClass = (layoutClass === '') ? layoutName : layoutClass;
  }
}

export default LayoutVO
