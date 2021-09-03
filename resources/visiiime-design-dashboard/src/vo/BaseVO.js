import uuid from '@/helper/uuid'

class BaseVO {
  constructor(obj, setUid = true) {
      if(setUid) {
        this.uid = uuid()

      }
      this.valid


    if(obj !== undefined) {
      this.assignValue(obj);
    }
  }

  assignValue(obj) {
    Object.keys(obj).forEach((key) => {
      if(key === 'valid' && obj[key] === 0) {
        this[key] = false
      } else {
        this[key] = obj[key]
      }
    });
  }
}

export default BaseVO
