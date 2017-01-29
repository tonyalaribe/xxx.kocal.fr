<template>
  <div class="tags__container">
    <div class="tags" v-for="tags, id in sortedTags">
      <h3 class="tags__title">{{ id.toUpperCase() }}</h3>
      <ul class="tags__list">
        <li v-for="tag in tags">
          <router-link :to="'/tags/' + tag.slug">{{ tag.tag }}</router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {}
    },

    computed: {
      sortedTags () {
        return this.$store.getters.sortedTags;
      }
    },

    mounted () {
      console.log('TagsList mounted.')
    }
  }
</script>

<style lang="scss" src="./styles/tags-list.scss"></style>
