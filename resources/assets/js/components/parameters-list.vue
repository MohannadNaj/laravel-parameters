<style scoped>
    .meta-list-group-item {
        padding: 0px;
        box-shadow: 0px 1px 2px black;
        margin-bottom: 20px;
    }
</style>
<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div v-if="parameters.length > 0" class="panel panel-default">
                    <div class="panel-heading">
                        {{ title }}
                        <span class="pull-right">
                            <span class="badge">{{ parameters.length }}</span>
                            <button type="button" class="btn btn-success btn-sm" @click="add">+</button>
                        </span>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <parameter class="list-group-item meta-list-group-item"
                            v-for="parameter in parameters"
                            :parameter="parameter"
                            :ref="'parameter'+parameter.id"
                            :key="parameter.id"></parameter>
                        </ul>
                    </div>
                </div>
                <div class="note-container" v-if="parameters.length == 0">
                    <add-category v-if="isCategoriesGroup"></add-category>
                    <div v-if="!isCategoriesGroup">
                        No Parameters Added, start by adding one
                        <add-parameter :is-categories-group="isCategoriesGroup" :category_id='category_id'></add-parameter>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                count: 0,
                title: '',
                category_id: '',
                isCategoriesGroup: false,
                parameters: []
            };
        },

        mounted() {
            this.registerEvents();
        },
        methods: {
            add() {
                var modal = Helper.modal;
                var componentTag, title;

                if(this.isCategoriesGroup) {
                    componentTag = 'add-category';
                    title = 'Add category: ';                    
                } else {
                    componentTag = 'add-parameter';
                    title = 'Add parameter: ';
                }

                modal.showComponent(componentTag, title);

                modal.showModalAfter(x => {
                    if(! this.isCategoriesGroup) {
                        var component = modal.$refs['component'];
                        component.data_category_id = this.category_id;
                    }
                });
            },
            created(parameter) {
                var modal = Helper.modal;

                this.$nextTick(x => {
                    modal.hideModal();
                    this.alert('Parameter ' + parameter.name + ' was just added succesfully');
                });                
            },
            registerEvents() {
                EventBus.listen('open-category', (data) => {
                    this.title = data.title;
                    this.parameters = data.parameters;
                    this.category_id = data.target;
                    this.isCategoriesGroup = data.isCategoriesGroup;
                });

                EventBus.listen('created-parameter', this.created);

                EventBus.listen('open-addParameter', this.openAddParameter);
                EventBus.listen('update-parameters', this.updateParameters);
            },
            updateParameters(parameters) {
                this.parameters = parameters;
            },
            openAddParameter() {
                this.category_id = '';
                this.isCategoriesGroup = false;
            }
        }
    }
</script>
