class BackgroundBaseVO {

  constructor(
    customBgOn = false,
    bgType,
    bgName,
    bgContent,
    bgColor
  ) {
    this.customBgOn = customBgOn
    this.bgType = bgType
    this.bgName = bgName
    this.bgContent = bgContent
    this.bgColor = bgColor
  }
}

export default BackgroundBaseVO;
