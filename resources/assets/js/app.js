require('./core');
require('./bootstrap');

const app = new Vue({
    el: '#app',
    mounted() {
    	Helper.modal = this.$refs['modal'];
    	Helper.dropzoneModal = this.$refs['dropzone-modal'];
    }
});

