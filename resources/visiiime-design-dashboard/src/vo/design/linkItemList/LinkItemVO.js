import BaseVO from "@/vo/BaseVO";

class LinkItemVO extends BaseVO {
    /**
     * @param  {String} id
     * @param  {String} linkName=''
     * @param  {String} link=''
     * @param  {Boolean} online=false
     * @param  {String} thumbnail=''
     * @param  {String} linkType
     * @param  {String} startAt=''
     * @param  {String} endAt=''
     * @param  {Object} linkCustomData
     * @param  {String} mediaOpenType='EXT'
     * @param  {String} mediaName=''
     * @param  {Object} collector={'collectTitle': '', 'collectType': '', 'collectRsp': ''}
     * @param  {Boolean} valid
     */
    constructor(id, linkName = "", link = "", online = false, thumbnail = "", linkType, startAt = "", endAt = "", linkCustomData, mediaOpenType = "EXT", mediaName = '', collector, valid = false) {
        if (typeof id === "object") {
            super(id);
        } else {
            super();
            this.id = id
            this.linkName = linkName;
            this.link = link;
            this.online = online;
            this.thumbnail = thumbnail;
            this.linkType = linkType;
            this.startAt = startAt;
            this.endAt = endAt;
            this.linkCustomData = linkCustomData;
            this.mediaOpenType = mediaOpenType;
            this.mediaName = mediaName;
            this.collector = collector;
            this.valid = valid;
        }

        this.setDefaultLinkCustomData();
        this.setDefaultCollector();
    }

    setDefaultLinkCustomData() {
        if (this.linkCustomData === undefined || this.linkCustomData === "" || this.linkCustomData === null) {
            this.linkCustomData = {
                linkAnimation: "",
                linkBgColor: "",
                linkTextColor: "",
            };
        }
    }

    setDefaultCollector() {
        if (this.collector === undefined || this.collector === "" || this.collector === null) {
            this.collector = {
                collectType: "",
                collectTitle: "",
                collectRsp: "",
            };
        }
    }
}

export default LinkItemVO;
