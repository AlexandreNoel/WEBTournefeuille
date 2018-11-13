import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import Api from './api'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './logger'
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.config.productionTip = false

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyBL5wwReFZULzsHE0wJSifX_g43OMWR2jo',
    libraries: 'places'
  }
})
Vue.use(Api)
Vue.use(Vuetify, {
  iconfont: 'md', // 'md' || 'mdi' || 'fa' || 'fa4'
  theme: {
    primary: '#545463',
    secondary: '#fcac38'
  }
})

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
