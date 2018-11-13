import Vue from 'vue'
import Router from 'vue-router'
import TheHome from './views/TheHome.vue'
import store from './store'

Vue.use(Router)

const ifNotAuthenticated = (to, from, next) => {
  if (!store.getters.isAuthenticated && !store.getters.isAdmin) {
    return next()
  }
  next('/')
}

const ifAuthenticated = (to, from, next) => {
  if (store.getters.isAuthenticated) {
    return next()
  }
  next('/signin')
}

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '*',
      redirect: '/'
    },
    {
      path: '/',
      name: 'home',
      component: TheHome
    },
    {
      path: '/search',
      name: 'search',
      props: route => ({ query: route.query }),
      component: () => import('./views/TheSearch.vue'),
      beforeEnter: (to, _, next) => {
        const query = to.query.q

        if (query && query.trim()) {
          next()
        } else {
          next('/')
        }
      }
    },
    {
      path: '/signin',
      name: 'signin',
      component: () => import('./views/TheSignIn.vue'),
      beforeEnter: ifNotAuthenticated
    },
    {
      path: '/signup',
      name: 'signup',
      component: () => import('./views/TheSignUp.vue'),
      beforeEnter: ifNotAuthenticated
    },
    {
      path: '/bars/:id',
      name: 'bars',
      component: () => import('./views/TheBar.vue')
    },
    {
      path: '/me',
      name: 'me',
      component: () => import('./views/TheMe/TheMe.vue'),
      beforeEnter: ifAuthenticated
    },
    {
      path: '/feed',
      name: 'feed',
      component: () => import('./views/TheFeed.vue'),
      beforeEnter: ifAuthenticated
    },
    {
      path: '/admin',
      name: 'admin',
      component: () => import('./views/TheAdmin.vue'),
      beforeEnter (to, from, next) {
        if (store.getters.isAdmin) {
          return next()
        }
        next('/')
      }
    },
    {
      path: '/addbar',
      name: 'addbar',
      props: route => ({ query: route.query }),
      component: () => import('./views/TheAddHome.vue'),
      beforeEnter: ifAuthenticated
    },
    {
      path: '/addsearch',
      name: 'addsearch',
      props: route => ({ query: route.query }),
      component: () => import('./views/TheAddSearch.vue'),
      beforeEnter: (to, _, next) => {
        const query = to.query.q
        if (query && query.trim() && ifAuthenticated) {
          next()
        } else {
          next('/')
        }
      }
    }
  ]
})
