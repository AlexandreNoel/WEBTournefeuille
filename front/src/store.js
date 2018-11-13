import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

const token = localStorage.getItem('user-token')
if (token) axios.defaults.headers.common['Authorization'] = token

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    user: JSON.parse(localStorage.getItem('user')),
    keywords: null
  },

  getters: {
    isAuthenticated: state => !!state.user,

    isAdmin: state => !!state.user && state.user.role === 'ADMIN',

    allowedUserKeywords ({ keywords, user }) {
      const userKeywordsIds = (user.keywords || []).map(k => k.id)
      return (keywords || []).filter(k => !userKeywordsIds.includes(k.id))
    }
  },

  mutations: {
    user (state, user) {
      state.user = user
    },
    userKeywords (state, keywords) {
      state.user.keywords = keywords
    },
    keywords (state, keywords) {
      state.keywords = keywords
    }
  },

  actions: {
    login ({ commit }, user) {
      return new Promise((resolve, reject) => {
        axios.post('/api/login', user)
          .then(res => {
            const token = res.headers.authorization
            const user = res.data

            localStorage.setItem('user-token', token)
            localStorage.setItem('user', JSON.stringify(user))
            commit('user', user)
            axios.defaults.headers.common['Authorization'] = token
            resolve()
          })
          .catch(err => {
            localStorage.removeItem('user-token')
            localStorage.removeItem('user')
            reject(err)
          })
      })
    },

    logout ({ commit }) {
      commit('user', null)
      localStorage.removeItem('user-token')
      localStorage.removeItem('user')
      delete axios.defaults.headers.common['Authorization']
    },

    keywords ({ commit, state }) {
      if (state.keywords) return

      return new Promise((resolve, reject) => {
        axios.get('/api/keywords')
          .then(res => res.data)
          .then(keywords => {
            commit('keywords', keywords)
            resolve()
          })
          .catch(reject)
      })
    },

    addKeywordsToUser ({ commit, state: { user, keywords } }, keywordsIds) {
      if (keywordsIds.length < 1) return

      return new Promise((resolve, reject) => {
        axios.post(`/api/users/${user.id}/keywords`, { keywordsIds })
          .then(() => {
            commit('userKeywords', [
              ...user.keywords,
              ...keywords.filter(k => keywordsIds.includes(k.id))
            ])
            resolve()
          })
          .catch(reject)
      })
    },

    deleteKeywordsOfUser ({ commit, state: { user }, dispatch }, keywordId) {
      return new Promise((resolve, reject) => {
        axios.delete(`/api/users/${user.id}/keywords/${keywordId}`)
          .then(() => {
            commit('userKeywords', user.keywords.filter(k => k.id !== keywordId))
            resolve()
          })
          .catch(err => {
            if (err.response.status === 401) dispatch('logout')
            reject(err)
          })
      })
    }
  }
})
