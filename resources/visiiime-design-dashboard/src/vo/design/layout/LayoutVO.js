
class LayoutVO {
  constructor(layoutName, layoutId, layoutClass = '') {
    this.layoutName = layoutName
    this.layoutId = layoutId
    this.layoutClass = (layoutClass === '') ? layoutName : layoutClass;
  }
}

export default LayoutVO
