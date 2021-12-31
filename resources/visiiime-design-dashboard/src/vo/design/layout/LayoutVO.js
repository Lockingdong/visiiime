
class LayoutVO {
  constructor(layoutName, layoutCode, layoutClass = '') {
    this.layoutName = layoutName
    this.layoutCode = layoutCode
    this.layoutClass = (layoutClass === '') ? layoutName : layoutClass;
  }

  async getLayoutData() {
    let data = await import(`../../../layout/${this.layoutCode}`)

    return data.default
  }
}

export default LayoutVO
