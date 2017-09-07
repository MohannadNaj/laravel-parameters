<template>
  <span @click="clicked = ! clicked">{{ message }}</span>
</template>
<script>
  export default {
    data () {
      return {
        message: 'hello!',
        clicked: false
      }
    },
    created () {
      this.message = 'bye!'
    }
  }
</script>
