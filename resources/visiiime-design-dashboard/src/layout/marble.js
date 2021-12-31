import { baseUrl } from '../helper/env'

// no-border sm-border md-border lg-border
// no-bdrs sm-bdrs md-bdrs lg-bdrs
// bgPlain bgGradient bgWave bgImage

// https://local-web.visiiime.com/VBasic/marble.png

export default {
    background: {
        customBgOn: true,
        bgType: "background",
        bgName: "bgImage",
        bgImage: baseUrl() + '/VBasic/marble.png',
        bgColor: "#ffffff",
        bgColor2: "#ffffff"
    },
    linkButton: {
        buttonName: "",
        buttonBorder: "no-border",
        buttonRadius: "sm-bdrs",
        buttonBgColor: "#333333",
        buttonTextColor: "#ffffff"
    },
    text: {
        textColor: "#333333"
    }
}