require('./vue-asset');
Vue.component('info-box', require('./components/dashboard/InfoBox.vue'));

var app = new Vue({
    el: '#inventory'
});