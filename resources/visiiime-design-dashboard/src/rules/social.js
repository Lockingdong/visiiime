import { extend } from "vee-validate";

const name = '-social';
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

extend(`yahoo${name}`,{
    validate(value){
        if(value) {
            return /yahoo/.test(value);
        }
        return false;
    },
    message: `yahoo ${msg}`

})

extend(`wechat${name}`,{
    validate(value){
        if(value) {
            return /weixin/.test(value);
        }
        return false;
    },
    message: `wechat ${msg}`
})

extend(`soundcloud${name}`,{
    validate(value) {
        if(value) {
            return /soundcloud/.test(value);
        }
        return false;
    },
    message: `soundcloud ${msg}`
})

extend(`skype${name}`, {
    validate(value) {
        if(value) {
            return /skype/.test(value);
        }
        return false;
    },
    message: `skype ${msg}`
})

extend(`shopee${name}`, {
    validate(value) {
        if(value) {
            return /shopee/.test(value);
        }
        return false;
    },
message: `shopee ${msg}`
})

extend(`pinterest${name}`,{
    validate(value) {
        if(value) {
            return /pin|pinterest/.test(value);
        }
        return false;
    },
    message: `pinterest${msg}`

})

extend(`linkin${name}`, {
    validate(value) {
        if(value) {
            return /linkedin/.test(value);
        }
        return false;
    },
    message: `linkedin${msg}`
})

extend(`line${name}`,{
    validate(value) {
        if(value) {
            return /line/.test(value);
        }
        return false;
    },
    message: `line${msg}`

})

extend(`dribbble${name}`, {
    validate(value) {
        if(value) {
            return /dribbble/.test(value);
        }
        return false;
    },
    message: `dribbble${msg}`
})

extend(`behance${name}`,{
    validate(value) {
        if(value) {
            return /behance/.test(value);
        }
        return false;
    },
    message: `behance${msg}`

})

extend(`whatsapp${name}` ,{
    validate(value) {
        if(value) {
            return /wa/.test(value);
        }
        return false;
    },
    message: `whatsapp${msg}`

})


extend(`twitter${name}` ,{
    validate(value) {
        if(value) {
            return /twitter/.test(value);
        }
        return false;
    },
    message: `twitter${msg}`

})

extend(`telegram${name}`,{
    validate(value) {
        if(value) {
            return /telegram/.test(value);
        }
        return false;
    },
    message: `telegram${msg}`
})

extend(`spotify${name}`, {
    validate(value) {
        if(value) {
            return /spotify/.test(value);
        }
        return false;
    },
    message: `spotify${msg}`
})

extend(`messenger${name}`,{
    validate(value) {
        if(value) {
            return /fb-messenger/.test(value);
        }
        return false;
    },
    message: `messenger${msg}`
})
