import "./bootstrap";

Vue.component('pagination', require("vue-bootstrap-pagination"));
Vue.component('toolbox', require("./components/Toolbox.vue"));

new Vue({
    el: '#app',
    template: '<app></app>',
    components: {
        app: require("./apps/Admin.vue"),
    }
});