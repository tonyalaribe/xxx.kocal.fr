/**
 * Created by kocal on 28/01/17.
 */
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    sortedTags: []
  },
  getters: {
    sortedTags: state => {
      return state.sortedTags
    }
  },
  actions: {
    setSortedTags({commit, state}, sortedTags) {
      commit('setSortedTags', {sortedTags})
    }
  },
  mutations: {
    setSortedTags(state, payloader) {
      Vue.set(state, 'sortedTags', payloader.sortedTags)
    }
  }
});
