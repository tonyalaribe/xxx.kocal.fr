<template>
  <div id="app">
    <transition name="fade" appear>
      <div id="loader" v-if="loading">
        <div class="circle"></div>
        <span class="message">{{ loadingMessage }}</span>
      </div>
    </transition>
    <transition name="fade">
      <div v-show="!loading">
        <app-header></app-header>
        <div id="app-content">
          <router-view></router-view>
          <tags-list></tags-list>
        </div>
        <app-footer></app-footer>
      </div>
    </transition>
  </div>
</template>

<script>
  import {mapActions} from 'vuex';

  export default {
    data () {
      return {
        loading: true,
        loadingMessage: ''
      }
    },
    mounted () {
      this.fetchJson('/api/sortedTags', json => {
        this.loadingMessage = 'Rendering tags...';
        this.$store.dispatch('setSortedTags', json.sortedTags);
        this.loading = false;
      });
    },
    methods: {
      fetchJson (url, cbSuccess) {
        this.loadingMessage = `GET ${url}...`;
        this.$http.get(url).then(res => {
          res.json().then(json => cbSuccess(json))
        }, err => this.loadingMessage = `${err.url}: ${err.status} ${err.statusText}`)
      }
    }
  }
</script>

<style src="../../../../../node_modules/bootstrap/dist/css/bootstrap-reboot.min.css"></style>
<style lang="scss" src="../styles/app.scss"></style>
<style lang="scss" src="../styles/transitions.scss"></style>
<style lang="scss" src="../styles/loader.scss"></style>
