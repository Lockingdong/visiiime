require('./bootstrap');

require('alpinejs');

// Require Vue
window.Vue = require('vue').default;

// Register Vue Components
Vue.component('example-component', require('./ExampleComponent.vue').default);

// Initialize Vue
const app = new Vue({
    el: '#app',
});
