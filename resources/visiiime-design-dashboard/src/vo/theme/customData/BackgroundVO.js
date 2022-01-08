import BaseVO from "@/vo/BaseVO";
class BackgroundBaseVO extends BaseVO {
    /**
     * obj param
     * @param  {Boolean} customBgOn=false
     * @param  {String} bgType=''
     * @param  {String} bgName=''
     * @param  {String} bgCustomImage=''
     * @param  {String} bgImage=''
     * @param  {String} bgColor=''
     * @param  {String} bgColor2=''
     */
    constructor(obj) {
        super(obj, false)
    }
}

export default BackgroundBaseVO;
