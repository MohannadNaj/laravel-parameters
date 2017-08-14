window.EventBus = new class {

	constructor() {
		this.vue = new Vue({methods: this.methods});
		return this.vue;
	}

	get methods() {
		return {
			fire(event, data = null) {
				this.$emit(event, data);
			},

			listen(event, callback) {
				this.$on(event, callback);
			}
		}
	}
}