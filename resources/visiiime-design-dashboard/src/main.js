import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

import "@/assets/css/tailwind.css";
import "vue-croppa/dist/vue-croppa.css";

import { extend, configure, ValidationObserver as VOb } from "vee-validate";
import * as rules from "vee-validate/dist/rules";
import { messages } from "vee-validate/dist/locale/zh_TW.json";
import VueSweetalert2 from "vue-sweetalert2";

import VModal from "vue-js-modal";

import Croppa from "vue-croppa";

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import vicon from "@/components/icon/VIcon";

// If you don't need the styles, do not connect
import "sweetalert2/dist/sweetalert2.min.css";
/**
 * vee validate
 */
configure({
    classes: {
        valid: "valid",
        invalid: "invalid",
    },
});

Object.keys(rules).forEach((rule) => {
    extend(rule, {
        ...rules[rule], // copies rule configuration
        message: messages[rule], // assign message
    });
});

Vue.component("fai", FontAwesomeIcon);

Vue.use(Croppa);

Vue.component("VOb", VOb);

Vue.component("vicon", vicon);

Vue.config.productionTip = false;

Vue.use(VueSweetalert2);

Vue.use(VModal);

new Vue({
    router,
    store,
    render: (h) => h(App),
}).$mount("#app");

extend("url", {
    validate(value) {
        if (value) {
            return /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([-.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/.test(value);
        }

        return false;
    },
    message: "網址格式錯誤",
});

extend("youtubeUrl", {
    validate(value) {
        if (value) {
            return /(?:youtube\.com\/\S*(?:(?:\/e(?:mbed))?\/|watch\?(?:\S*?&?v=))|youtu\.be\/)([a-zA-Z0-9_-]{6,11})/.test(value);
        }

        return false;
    },
    message: "youtube網址格式錯誤",
});

extend("spotifyUrl", {
    validate(value) {
        if (value) {
            return /(https:\/\/open.spotify.com\/(track|user|artist|album|show)\/[a-zA-Z0-9]+(\/playlist\/[a-zA-Z0-9]+|)|spotify:(track|user|artist|album):[a-zA-Z0-9]+(:playlist:[a-zA-Z0-9]+|))/.test(value);
        }

        return false;
    },
    message: "spotify網址格式錯誤",
});

extend("applePUrl", {
    validate(value) {
        if (value) {
            return /https:\/\/?(podcasts|itunes).apple.com\/?/.test(value);
        }

        return false;
    },
    message: "apple podcast 網址格式錯誤",
});

extend("soundcloudUrl", {
    validate(value) {
        if (value) {
            return /https:\/\/\/?soundcloud.com\/?/.test(value);
        }
        return false;
    },
    message: "soundcloud 網址格式錯誤",
});
