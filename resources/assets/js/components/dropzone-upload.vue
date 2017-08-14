<template>
    <div>
        <div class="modal fade" :id="modalId" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" :id="modalId + 'Label'">{{ header_msg }}</h4>
              </div>
              <div id="modal-dropzone" class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form v-bind:action="target_action" id="profile-upload" class="text-center dropzone">
                            <input type="hidden" name="_token" v-model="csrf">
                        </form>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                <button @click="saveChanges" type="button" class="btn btn-primary">حفظ التغييرات</button>
              </div>
            </div>
          </div>
        </div>
    </div>
</template>

<script>
    import dropzone_settings from './../settings/dropzone-settings.js';

    export default {
        data() {
            return {
                is_uploaded: false,
                csrf: '',
                path: null,
                window: window,
                handlerInstance: null,
                header_msg:'',
                target_action: window.Laravel.base_url + this._target,
                additionalParams: {},
                update_target: window.Laravel.base_url + this._update_target
            }
        },
        props: {
            _target:'',
            _update_target:'',
            modalId: {default: 'profile_upload'}
        },
        computed: {
            requestParams() {
                return _.merge(_.clone(this.additionalParams), {'path': this.path});
            },
            modal() {
                return $('#' + this.modalId);
            }
        },
        mounted() {
            this.init();
        },
        methods: {
            init() {
                this.csrf = window.Laravel.csrfToken;

                if(typeof window.uploadInstances == "undefined") {
                    window.uploadInstances = {};
                }

                window.uploadInstances[this.modalId] = this;
                dropzone_settings.handlerInstance = this;
                window.Dropzone.options.profileUpload = dropzone_settings;
            },
            setUploadInstance() {
                window.vue_profile_upload = this;
            },
            handleRespnose(file,  responseText) {
                if(typeof responseText.path != "undefined") {
                    this.path = responseText.path ;
                    this.is_uploaded = true;
                } else {
                    this.is_uploaded = false;
                }
            },
            saveChanges() {

                if(! this.is_uploaded)
                    return ;

                this.modal.modal('hide');
                this.$http.post(this.update_target, this.requestParams)
                .then(response => {
                    if(typeof response.data.path == "undefined")
                        return ;

                    var vm = this;
                    this.modal.on('show.bs.modal', function() {
                        vm.init();
                    });

                    window.dropzone_instance.removeAllFiles();
                    this.is_uploaded = false;
                    this.path = null;
                    if(typeof this.handlerInstance != "object")
                        return ;
                    this.handlerInstance.$emit('file-uploaded', response.data);
                });

            }
        }
    }
</script>