import Parts from '@/enum/parts/Parts';

class VBasicThemeVO {
  /**
   * @param  {AvatarVO} avatar
   * @param  {UserTitleVO} userTitle
   * @param  {DescriptionVO} description
   * @param  {LinkItemListVO} linkItemListMain
   * @param  {LinkItemListVO} linkItemList
   * @param  {LinkItemListVO} linkItemListSocial
   * @param  {LayoutVO} layout
   * @param  {VBasicCustomDataVO} customData
   * @param  {UrlVO} url
   */
  constructor(
    avatar,
    userTitle,
    description,
    linkItemListMain,
    linkItemList,
    linkItemListSocial,
    layout,
    customData,
    url
  ) {
    this.avatar = avatar
    this.userTitle = userTitle
    this.description = description
    this.linkItemListMain = linkItemListMain
    this.linkItemList = linkItemList
    this.linkItemListSocial = linkItemListSocial
    this.layout = layout
    this.customData = customData
    this.url = url
  }

  getRsp() {

    let parts = new Parts();
    return {
      [parts.getEnum('avatar')]: this.avatar,
      [parts.getEnum('userTitle')]: {
        title: this.userTitle.title
      },
      [parts.getEnum('description')]: {
        text: this.description.text
      },
      [parts.getEnum('linkItemListMain')]: {
        list: this.linkItemListMain.getRspList()
      },
      [parts.getEnum('linkItemList')]: {
        list: this.linkItemList.getRspList()
      },
      [parts.getEnum('linkItemListSocial')]: {
        list: this.linkItemListSocial.getRspList()
      },
      [parts.getEnum('layout')]: {
        layoutClass: this.layout.layoutClass,
        layoutName: this.layout.layoutName
      },
      [parts.getEnum('customData')]: {
        customData: this.customData
      }
    }
  }
}

export default VBasicThemeVO;
