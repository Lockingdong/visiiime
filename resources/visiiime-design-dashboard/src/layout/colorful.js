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
        bgImage: baseUrl() + '/VBasic/colorful.png',
        bgColor: "#fea7e6",
        bgColor2: "#8991fe"
    },
    linkButton: {
        buttonName: "",
        buttonBorder: "no-border",
        buttonRadius: "sm-bdrs",
        buttonBgColor: "#1a237e",
        buttonTextColor: "#ffffff"
    },
    text: {
        textColor: "#333333"
    }
}