import uuid from '@/helper/uuid'

class BaseVO {
  constructor(obj) {
    this.uid = uuid()
    this.valid = false

    if(obj !== undefined) {
      this.assignValue(obj);
    }
  }

  assignValue(obj) {    
    Object.keys(obj).forEach((key) => {
      this[key] = obj[key]
    });
  }
}

export default BaseVO