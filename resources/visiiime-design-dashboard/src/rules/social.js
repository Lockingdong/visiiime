import { extend } from "vee-validate";

const name = 'Social';
const msg = '網址格式錯誤';

extend(`facebook${name}`, {
    validate(value) {
        if (value) {
            return /facebook/.test(value);
        }
        return false;
    },
    message: `facebook ${msg}`,
});

extend(`instagram${name}`, {
    validate(value) {
        if (value) {
            return /instagram/.test(value);
        }
        return false;
    },
    message: `instagram ${msg}`,
});

extend(`youtube${name}`, {
    validate(value) {
        if (value) {
            return /youtube/.test(value);
        }
        return false;
    },
    message: `youtube ${msg}`,
});
