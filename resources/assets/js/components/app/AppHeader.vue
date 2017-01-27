<template>
  <header role="banner">
    <h1>xxx.kocal.fr</h1>
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

<style lang="scss" scoped>
  @import "../../../sass/_colors.scss";

  header {
    font-size: 2.4rem;

    text-align: center;

    background-color: $header-bg;
    color: $header-fg;
    text-shadow: -1px -1px 0 darken($header-bg, 10%), 1px 1px 0 lighten($header-fg, 10%);
    box-shadow: 0 0 50px rgba($header-bg, 50%);
  }
</style>
