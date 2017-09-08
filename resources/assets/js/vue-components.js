Vue.component('dropzone-upload', require('./components/dropzone-upload.vue'))
Vue.component('modal', require('./components/modal.vue'))

Vue.component('parameters', require('./components/parameters.vue'))

// Merge Axios into Vue
window.Vue.prototype.$http = window.axios

// Vue-Notifyjs
require('./utils/vue-notifyjs')
// Helpers
require('./utils/Helper')
