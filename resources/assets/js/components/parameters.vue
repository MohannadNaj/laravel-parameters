<template>
  	<div class="row">
  		<div class="col-sm-3">
  			<div class="list-group">
	            <parameters-category
		            :ref="category.target + '_parameter_category'"
		            :key="category.target + '_cat'"
		            :title="category.title"
		            :parameters="category.parameters"
		            :is-categories-group="category.isCategoriesGroup"
		            :blocked="category.blocked"
		            :target="category.target"
		            v-if="shouldShowCategory(category)"
		            :related-parameter="category.relatedParameter"
		            v-for="category in categories"
				></parameters-category>
				<div class="list-group-item">
                    <button @click="toggleEditCategories" type="button" class="btn btn-default btn-sm">
                    	Edit Categories
                        <i class="fa fa-pencil" v-show="editCategoriesMode"></i>
                    </button>
				</div>
				<div class="note-container" v-if="categories.length <= 1">
					No Categories Found, Start by Adding one
					<add-category></add-category>
				</div>
        </div>
      </div>
      <div class="col-sm-9">
  			<parameters-list ref="parameters"></parameters-list>
  	  </div>
      <dropzone-upload ref="dropzone-modal" _target="parameters/addPhoto" _update_target="parameters/updatePhoto"></dropzone-upload>
    </div>
	
</template>

<script>
	import base from './mixins/parameters/base.js'
	export default {
		mixins: [base],
		data() {
			return {
				categories: [],
				parameters: [],
				openedCategory: null,
				categoriesParameters: [],
				editCategoriesMode: false,
			}
		},
		mounted() {
			this.parameters = this.parameters_list;
			this.registerEvents();
			this.loadParameters();
		},
		props: {
			parameters_list: null,
		},
		methods: {
			loadParameters() {
				this.prepareCategories();
				this.$nextTick(this.openCategoryByHash);
			},
			registerEvents() {
		        EventBus.listen('opening-category', data => {
		            this.deactivateCategories();
		            this.openCategory(data);
		        });
		        EventBus.listen('change-paramCategory', this.changeParamCategory);
		        EventBus.listen('chose-paramCategory', this.choseParamCategory);
		        EventBus.listen('created-category', this.createdCategory);
		        EventBus.listen('parameter-updated', this.updateCategoryParameter);
		        EventBus.listen('created-parameter', this.createdParameter);
		        EventBus.listen('confirm-removeParameter', this.confirmRemoveParameter);
		        EventBus.listen('cancel-removeParameter', this.cancelRemoveParameter);
		        EventBus.listen('confirmed-removeParameter', this.confirmedRemoveParameter);
			},
	    }
	}
</script>