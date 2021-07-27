import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";

import VueTailwind from 'vue-tailwind'
import { settings } from './vuetailwind'

import "@/assets/css/tailwind.css";
import "vue-croppa/dist/vue-croppa.css";

import { configure, ValidationObserver as VOb } from "vee-validate";
import './rules'

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

Vue.component("fai", FontAwesomeIcon);

Vue.use(Croppa);

Vue.component("VOb", VOb);

Vue.component("vicon", vicon);

Vue.config.productionTip = false;

Vue.use(VueSweetalert2);

Vue.use(VModal);

Vue.use(VueTailwind, settings)

const req = require.context('@/components/el', true, /\.(js|vue)$/i);
req.keys().map(key => {
    const name = key.match(/\w+/)[0];
    Vue.component(name, () => import(`@/components/el/${name}`))
});

new Vue({
    router,
    store,
    render: (h) => h(App),
}).$mount("#app");

