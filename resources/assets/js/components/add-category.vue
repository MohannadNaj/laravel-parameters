		<style scoped>

		</style>
		<template>
			<div>
				<form method="POST" role="form" v-on:submit.prevent="createCategory">
					<div class="form-group">
						<label>New Category?</label>
						<input type="text" class="form-control" v-model="newCategoryName">
					</div>
					<button type="submit" :disabled="!valideCategoryName" class="btn btn-primary">Add+</button>
				</form>
			</div>
		</template>

		<script>

export default {
  data() {
    return {
      newCategoryName: ''
    }
  },
  props: {
    detailedView: false
  },
  mounted() {},
  methods: {
    createCategory() {
      EventBus.fire('start-addCategory')
      this.$http
        .post(window.Laravel.base_url + 'parameters/addCategory', {
          value: this.newCategoryName
        })
        .then(response => {
          var data = response.data
          EventBus.fire('created-category', data.parameter)
          EventBus.$nextTick(x => {
            this.newCategoryName = ''
          })
          EventBus.fire('end-addCategory')
        })
        .catch(error => {
          var errorMessage = 'Error in adding category'
          var errorData = error.response.data
          Helper.checkCommonErrors(errorData, errorMessage)
          EventBus.fire('end-addCategory')
        })
    }
  },
  computed: {
    valideCategoryName() {
      return this.newCategoryName.length != 0
    }
  }
}

</script>