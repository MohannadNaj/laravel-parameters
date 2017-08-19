
Vue.component('dropzone-upload', require('./components/dropzone-upload.vue'));
Vue.component('modal', require('./components/modal.vue'));


Vue.component('parameters', require('./components/parameters.vue'));
Vue.component('parameters-list', require('./components/parameters-list.vue'));
Vue.component('parameter', require('./components/parameter.vue'));
Vue.component('parameter-meta', require('./components/parameter-meta.vue'));
Vue.component('parameters-category', require('./components/parameters-category.vue'));

Vue.component('change-paramCategory', require('./components/change-paramCategory.vue'));
Vue.component('add-category', require('./components/add-category.vue'));
Vue.component('remove-parameter', require('./components/remove-parameter.vue'));
Vue.component('add-parameter', require('./components/add-parameter.vue'));

// Editors
Vue.component('editor-boolean', require('./components/editors/boolean.vue'));
Vue.component('editor-file', require('./components/editors/file.vue'));
Vue.component('editor-integer', require('./components/editors/integer.vue'));
Vue.component('editor-text', require('./components/editors/text.vue'));
Vue.component('editor-textfield', require('./components/editors/textfield.vue'));

// Merge Axios into Vue
window.Vue.prototype.$http = window.axios;

// Vue-Notifyjs
require('./utils/vue-notifyjs');
// Helpers
require('./utils/Helper');
