<template>
  <div class="in-front-tag__container">
    <div v-for="inFrontTag in inFrontTags" class="in-front-tag">
      <router-link :to="'/tags/' + inFrontTag.tag.slug">
        <img class="in-front-tag__thumbnail" :src="inFrontTag.video.thumbnail_url" :alt="inFrontTag.tag.tag">
        <span class="in-front-tag__name">{{inFrontTag.tag.tag}}</span>
      </router-link>
    </div>
  </div>
</template>

<script>
  export default {
    computed: {
      inFrontTags () {
        return this.$store.getters.inFrontTags
      }
    }
  }
</script>
<style lang="scss" src="../styles/page-index.scss"></style>
