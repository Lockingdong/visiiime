class SocialLinksVO {
  /**
   * @param  {array} arr=[]
   */
  constructor(arr = []) {
    this.list = arr;
  }

  getRspList() {
    return this.list.filter(item => item.valid === true);
  }
}

export default SocialLinksVO