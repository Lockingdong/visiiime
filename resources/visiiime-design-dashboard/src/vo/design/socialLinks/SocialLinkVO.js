class SocialLinkVO {
  /**
   * @param  {string} fa
   * @param  {string} icon
   * @param  {string} link
   * @param  {boolean} valid
   */
  constructor(fa, icon, link = '', valid = false) {
    this.fa = fa
    this.icon = icon;
    this.link = link;
    this.valid = valid;
  }
}

export default SocialLinkVO