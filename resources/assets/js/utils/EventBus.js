window.EventBus = new class {
  constructor() {
    this.vue = new Vue({ methods: this.methods , data: this.data })
    return this.vue
  }

  get data() {
    return {
      history: []
    }
  }

  get methods() {
    return {
      fire(event, data = null) {
        this.record(event, data)
        this.$emit(event, data)
      },

      listen(event, callback) {
        this.$on(event, callback)
      },

      record(event, data = null) {
        var recordedEvent = {}
        recordedEvent[event] = data
        this.history.push(recordedEvent)
      },

      getHistoryEvents() {
        var res = []
        this.history.forEach((item) => {
          res.push(_.keys(item)[0])
        })
        return res
      }
    }
  }
}()
