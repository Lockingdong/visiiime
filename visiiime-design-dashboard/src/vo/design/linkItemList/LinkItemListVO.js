import { linkType } from "../../../enum/vo/LinkItemEnum";

class LinkItemListVO {
  constructor(arr = []) {
    this.list = arr;
  }

  getRspList() {
    let list = this.list.map(item => {
      return {
        linkType: item.linkType,
        linkName: item.linkName,
        link: item.link,
        online: item.online,
        thumbnail: item.thumbnail,
        startAt: item.startAt,
        endAt: item.endAt,
        linkCustomData: item.linkCustomData,
        mediaOpenType: item.mediaOpenType,
        mediaName: item.mediaName,
        collector: item.collector
      }
    });

    return list.filter(item => item.online === true);
  }
}

export default LinkItemListVO
