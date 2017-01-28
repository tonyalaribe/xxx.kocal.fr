/**
 * Created by kocal on 28/01/17.
 */
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    tags: []
  },
  getters: {
    tags: state => {
      return state.tags
    }
  },
  actions: {
    setTags({commit, state}, tags) {
      commit('setTags', {tags})
    }
  },
  mutations: {
    setTags (state, payloader) {
      Vue.set(state, 'tags', payloader.tags)
    }
  }
});
