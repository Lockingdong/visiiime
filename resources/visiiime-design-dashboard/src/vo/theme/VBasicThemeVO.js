import Parts from '@/enum/parts/Parts';

class VBasicThemeVO {
  /**
   * @param  {AvatarVO} avatar
   * @param  {UserTitleVO} userTitle
   * @param  {DescriptionVO} description
   * @param  {LinkItemListVO} linkItemListMain
   * @param  {LinkItemListVO} linkItemList
   * @param  {SocialLinksVO} SocialLinks
   * @param  {LayoutVO} layout
   * @param  {VBasicCustomDataVO} customData
   */
  constructor(
    avatar,
    userTitle,
    description,
    linkItemListMain,
    linkItemList,
    socialLinks,
    layout,
    customData
  ) {
    this.avatar = avatar
    this.userTitle = userTitle
    this.description = description
    this.linkItemListMain = linkItemListMain
    this.linkItemList = linkItemList
    this.socialLinks = socialLinks
    this.layout = layout
    this.customData = customData
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
      [parts.getEnum('SocialLinks')]: {
        list: this.socialLinks.getRspList()
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
