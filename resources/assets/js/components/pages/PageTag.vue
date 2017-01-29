<template>
  <div>
    <h2>Videos tagged as « {{tag}} »</h2>

    <transition name="fade" mode="out-in">
      <div v-show="!loading" class="videos__container">
        <div class="video" v-for="video in videos">
          <a target="_blank"
             :href="video.site_url + video.video_url"
             :title="'See « ' + video.video_title + ' » on ' + video.site_name">
            <img class="video__thumbnail" :src="video.video_thumbnail_url" :alt="video.video_title">
            <span class="video__title">{{video.video_title}}</span>
          </a>
        </div>
      </div>
    </transition>

    <div class="pagination__container">
      <v-paginator :resource_url="'/api/tag/' + tag" @update="updateResource"></v-paginator>
    </div>
  </div>
</template>
<script>
  export default {
    data () {
      return {
        tag: this.$route.params.tag,
        videos: [],
        loading: true,
      }
    },
    methods: {
      updateResource(data) {
        this.videos = data;
        this.loading = false;
      }
    },
    watch: {
      '$route' (to, from) {
        this.tag = to.params.tag;
        $('html, body').animate({scrollTop: 0}, 400);
        this.loading = true;
      }
    }
  }
</script>
<style lang="scss" src="../styles/page-tag.scss" scoped></style>
