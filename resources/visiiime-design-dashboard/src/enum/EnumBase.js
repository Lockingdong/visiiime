class EnumBase {

  constructor(enumObj) {
    this.enumObj = enumObj;
  }

  getEnum(key) {
    if (this.enumObj[key] === undefined) {
      console.log(key + " undefined");
      return "undefined key";
    }
    return this.enumObj[key];
  }

  getPartName(pnum) {
    let key = Object.keys(this.enumObj).find((key) => this.enumObj[key] === pnum);
    if (key === undefined) {
      console.log(pnum + " undefined");
      return "undefined enum";
    }

    return key;
  }
}

export default EnumBase
