/**
 * Created by kocal on 28/01/17.
 */
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    inFrontTags: [],
    sortedTags: {},
  },
  getters: {
    inFrontTags: state => state.inFrontTags,
    sortedTags: state => state.sortedTags,
  },
  actions: {
    setInFrontTags({commit, state}, inFrontTags) {
      commit('setInFrontTags', {inFrontTags})
    },
    setSortedTags({commit, state}, sortedTags) {
      commit('setSortedTags', {sortedTags})
    }
  },
  mutations: {
    setInFrontTags(state, payloader) {
      Vue.set(state, 'inFrontTags', payloader.inFrontTags)
    },
    setSortedTags(state, payloader) {
      Vue.set(state, 'sortedTags', payloader.sortedTags)
    }
  }
});
