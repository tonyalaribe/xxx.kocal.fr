<template>
  <header role="banner">
    <h1><router-link to="/">xxx.kocal.fr</router-link></h1>
  </header>
</template>

<script>
  export default {
    data () {
      return {}
    },

    mounted () {
      console.log('PageHeader mounted')
    }
  }
</script>

<style lang="scss" scoped src="../styles/app-header.scss"></style>
