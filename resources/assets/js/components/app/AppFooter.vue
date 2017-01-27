<template>
  <footer role="contentinfo">
    <p><a href="https://twitter.com/Kocal_" rel="author">@Kocal_</a> &bull; 2017</p>
    <p>I do not own any adult content displayed on this website.</p>
  </footer>
</template>

<script>
  export default {
    data () {
      return {}
    },

    mounted () {
      console.log('PageFooter mounted')
    }
  }
</script>


<style lang="scss" scoped>
  @import "../../../sass/_colors.scss";

  footer {
    padding-top: 1em;
    text-align: center;
    background-color: $footer-bg;
    color: $footer-fg;
    box-shadow: 0 0 50px rgba($footer-bg, 50%);
  }
</style>
